<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $message = strtolower($request->message);
        $user = Auth::user();

        // USER INFO
        $customer = null;

        if ($user) {

        $customer = Customer::query()
        ->where('email', $user->email)
        ->first();

        }

        $customerInfo = '';

        if ($customer) {

            $customerInfo = "

            Customer Name: {$customer->customer_name}
            Tier: {$customer->tier}
            Member Points: {$customer->member_points}
            Total Spend: {$customer->total_spend}

            ";

        }

        // FAQ BROOLE

        if (
            str_contains($message, 'complaint') ||
            str_contains($message, 'keluhan') ||
            str_contains($message, 'refund') ||
            str_contains($message, 'problem')
        ) {

            return response()->json([
                'reply' =>
                'For further assistance, please contact our customer support Jessie at 08999300200.'
            ]);
        }

        if (
            str_contains($message, 'instagram') ||
            str_contains($message, 'tiktok') ||
            str_contains($message, 'social media')
        ) {

            return response()->json([
                'reply' =>
                'Follow us on Instagram and TikTok: @frombroole'
            ]);
        }

        if (
            str_contains($message, 'location') ||
            str_contains($message, 'booth') ||
            str_contains($message, 'where')
        ) {

            return response()->json([
                'reply' =>
                'You can find From Broole at UC Walk every day from 08.00 - 17.00 WIB.'
            ]);
        }

        // PRODUCT DATABASE

        $products = Product::with('category')->get();

        $productText = $products
            ->map(function ($product) {

                return "
                Product: {$product->pro_name}
                Price: Rp{$product->pro_price}
                Category: " . ($product->category->cat_name ?? '-');
            })
            ->join("\n");

        $prompt = "

        You are From Broole AI Sweet Guide.

        IMPORTANT RULES:

        - Keep responses under 80 words.
        - Be friendly and concise.
        - Never use long introductions.
        - Never write paragraphs longer than 3 lines.
        - Use emojis occasionally.
        - Recommend products directly.
        - Speak like a premium dessert assistant.
        - Do not repeat company information unless asked.
        - Only provide support number if customer asks for help, complaints, refunds, damaged orders, or issues.
        - If customer information is available, address the customer by their first name occasionally.
        - Donot mention the customer's email address.
        - Make recommendations feel personal.
        - Answer in English.

        Business Information:

        Customer Support:
        Jessie (08999300200)

        Location:
        UC Walk

        Operating Hours:
        10.00 - 22.00 WIB

        Instagram:
        @frombroole

        Drink Sweetness Options:
        100% Sugar
        50% Sugar
        No Sugar

        Recommend 50% Sugar or No Sugar for customers who prefer less sweetness.

        Current Customer Information:

        $customerInfo

        Products:
        $productText

        Customer:
        {$request->message}

        ";

        // GEMINI
        $response = Http::post(
        'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . env('GEMINI_API_KEY'),
        [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ]
        ]
    );

    $reply = data_get(
        $response->json(),
        'candidates.0.content.parts.0.text'
    );

    if ($response->successful() && $reply) {

    return response()->json([
        'reply' => $reply
    ]);

}

    // FALLBACK GROQ
        $response = Http::withHeaders([

    'Authorization' =>
        'Bearer ' . env('GROQ_API_KEY'),

    'Content-Type' =>
        'application/json',

])->post(

    'https://api.groq.com/openai/v1/chat/completions',

    [

        'model' =>
            'llama-3.3-70b-versatile',

        'messages' => [

            [
                'role' => 'system',

                'content' => $prompt
            ],

            [
                'role' => 'user',

                'content' => $request->message
            ]

        ],

        'temperature' => 0.7,

        'max_tokens' => 300

    ]

);

if (!$response->successful()) {

    return response()->json([

        'reply' =>
        '🍰 AI Sweet Guide is currently busy. Try again later.'

    ]);

}

$reply = data_get(
    $response->json(),
    'choices.0.message.content'
);

return response()->json([
    'reply' => $reply
]);
        
    }
}