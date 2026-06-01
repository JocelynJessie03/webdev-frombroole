
@extends('layouts.app')

@section('title', 'Message Sent')

@section('content')

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<section class="min-h-screen bg-[#FAF3E8] flex items-center justify-center px-6">

    <div class="max-w-2xl w-full">

        <div
            class="bg-white rounded-[40px] p-12 text-center shadow-[0_30px_80px_rgba(0,0,0,.08)] border border-[#E8DCC7]">

            {{-- Success Icon --}}
            <div
                class="w-28 h-28 mx-auto rounded-full bg-gradient-to-br from-[#B81C1C] to-[#6B0F1A] flex items-center justify-center shadow-xl">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-14 h-14 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7" />
                </svg>

            </div>

            {{-- Badge --}}
            <div
                class="inline-flex items-center gap-2 mt-8 px-4 py-2 rounded-full bg-[#FFF7E8] text-[#B81C1C] text-sm font-semibold tracking-wide uppercase">
                Message Delivered
            </div>

            {{-- Title --}}
            <h1
                class="mt-6 text-5xl md:text-6xl font-black text-[#1A0E08] leading-tight">
                Thank You!
            </h1>

            <h2
                class="mt-3 text-2xl font-serif italic text-[#B81C1C]">
                We've received your message.
            </h2>

            {{-- Description --}}
            <p
                class="mt-6 text-gray-600 leading-8 max-w-xl mx-auto">
                Thank you for reaching out to From Broole.
                Our team will review your message and get back
                to you as soon as possible.
            </p>

            {{-- Action Buttons --}}
            <div
                class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

                <a href="{{ route('customer.home') }}"
                    class="px-8 py-4 rounded-full bg-[#6B0F1A] text-white font-semibold hover:scale-105 transition">

                    Back To Home
                </a>

                <a href="https://wa.me/6281953801565"
                    target="_blank"
                    class="px-8 py-4 rounded-full border-2 border-green-600 text-green-700 font-semibold hover:bg-green-600 hover:text-white transition">

                    Chat via WhatsApp
                </a>

            </div>

            {{-- Extra Info --}}
            <div
                class="mt-10 pt-8 border-t border-gray-100 text-sm text-gray-500">

                Average response time:
                <span class="font-semibold text-[#B81C1C]">
                    under 24 hours
                </span>

            </div>

        </div>

    </div>

</section>

@endsection
