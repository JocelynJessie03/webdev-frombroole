<div
    x-data="chatWidget()"
    class="fixed z-[9999]"
    style="bottom: 2.5rem; right: 2rem;"
>

    {{-- Floating Button --}}
    <button
        :class="open ? 'scale-0 opacity-0' : 'scale-100 opacity-100'"
        @click="open = true"
        class="
        w-16 h-16
        rounded-full
        bg-gradient-to-br from-[#8B0F17] to-[#B41520]
        text-white
        shadow-[0_20px_40px_rgba(139,15,23,0.35)]
        flex items-center justify-center
        text-2xl
        hover:scale-105
        transition
        "
    >
        <span x-show="!open">✨</span>
        <span x-show="open">✕</span>
    </button>

    {{-- Chat Panel --}}
    <div
    x-show="open"
    x-cloak

    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-8 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"

    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-8 scale-90"

    @click.outside="open = false"

    class="
    absolute
    bottom-20
    right-0
    w-[calc(100vw-48px)]
    max-w-[390px]

    h-[75vh]
    max-h-[720px]
    bg-white
    rounded-[28px]
    shadow-[0_25px_80px_rgba(123,0,0,0.18)]
    overflow-hidden
    flex
    flex-col
    "
    >

        {{-- Header --}}
        <div
            class="
            bg-gradient-to-r
            from-[#7A0E15]
            via-[#94141E]
            to-[#B41520]
            backdrop-blur-xl
            text-white
            px-5
            py-4
            "
        >

            <div class="flex justify-between items-center">

                <div class="flex items-center gap-3">

                    <div
                        class="
                        w-10 h-10
                        rounded-full
                        bg-white/15
                        flex
                        items-center
                        justify-center
                        "
                    >
                        ✨
                    </div>

                    <div>

                        <h3 class="font-bold text-[15px]">
                            🍓 From Broole AI Sweet Guide
                        </h3>

                        <p class="text-[11px] opacity-80 uppercase tracking-wider">
                           Helping You Find Your Perfect Treat
                        </p>

                    </div>

                </div>

                <button
                    @click="open = false"
                    class="text-xl"
                >
                    ✕
                </button>

            </div>

        </div>

        {{-- Body --}}
        <div
            x-ref="chatContainer"
            class="flex-1 overflow-y-auto bg-[#FAF8F5]"
        >

            {{-- Welcome Card --}}
            <div class="p-4">

                <div
                    class="
                    bg-white
                    rounded-3xl
                    p-4
                    shadow-sm
                    border
                    border-[#F0ECE8]
                    "
                >

                    <p class="text-sm text-[#5F5B57] leading-relaxed">

                        Welcome to
                        <span class="font-bold text-[#2F2A26]">
                        From Broole
                        </span>,
                        Sweet Guest! ✨

                        <br><br>

                        I am your personal
                        <span class="italic">
                            From Broole AI Sweet Guide.
                        </span>

                        How may I sweeten your day?

                        Ask me for custom pairings,
                        flavor details,
                        or our TOP treats!

                    </p>

                </div>

            </div>

            {{-- Quick Inquiries --}}
            <div class="px-4 pb-4">

                <p
                    class="
                    text-[10px]
                    font-bold
                    uppercase
                    tracking-[0.2em]
                    text-[#A79C91]
                    mb-3
                    "
                >
                    Quick Inquiries
                </p>

                <div class="space-y-2">

                    <button
                        @click="
                        input='Suggest a dessert for my mood';
                        sendMessage();
                        "
                        class="
                        w-full
                        text-left
                        bg-[#F5F1EC]
                        hover:bg-[#EEE7E0]
                        rounded-full
                        px-4
                        py-3
                        text-sm
                        transition
                        "
                    >
                        🍰 Suggest a dessert for my mood...
                    </button>

                    <button
                        @click="
                        input='Tell me about Matcha Broole';
                        sendMessage();
                        "
                        class="
                        w-full
                        text-left
                        bg-[#F5F1EC]
                        hover:bg-[#EEE7E0]
                        rounded-full
                        px-4
                        py-3
                        text-sm
                        transition
                        "
                    >
                        🍵 Tell me about Matcha Broole
                    </button>

                    <button
                        @click="
                        input='What is the freshest treat today?'
                        sendMessage();                   
                        "
                        class="
                        w-full
                        text-left
                        bg-[#F5F1EC]
                        hover:bg-[#EEE7E0]
                        rounded-full
                        px-4
                        py-3
                        text-sm
                        transition
                        "
                    >
                        🍓 What is the freshest treat today?
                    </button>

                    <button
                        @click="
                        input='Best pairing for cold-brew coffee'
                        sendMessage();
                        "
                        class="
                        w-full
                        text-left
                        bg-[#F5F1EC]
                        hover:bg-[#EEE7E0]
                        rounded-full
                        px-4
                        py-3
                        text-sm
                        transition
                        "
                    >
                        ☕ Best pairing for cold-brew coffee
                    </button>

                </div>

            </div>

            {{-- Messages --}}
           <div class="p-4 space-y-3">

            <template
                x-for="message in messages"
                :key="message.id"
            >

                <div
                    class="flex"
                    :class="
                        message.role === 'user'
                        ? 'justify-end'
                        : 'justify-start'
                    "
                >

                    {{-- Loading --}}
                    <template x-if="message.loading">
                        <div
                            class="
                            bg-white
                            border border-[#EFE9E4]
                            rounded-3xl
                            px-5
                            py-4
                            shadow-sm
                            "
                        >

                            <div class="flex gap-2">

                                <div
                                    class="
                                    w-3 h-3 rounded-full
                                    bg-gradient-to-r
                                    from-[#9E111B]
                                    to-[#D14A4A]
                                    animate-bounce
                                    "
                                ></div>

                                <div
                                    class="
                                    w-3 h-3 rounded-full
                                    bg-gradient-to-r
                                    from-[#9E111B]
                                    to-[#D14A4A]
                                    animate-bounce
                                    [animation-delay:0.15s]
                                    "
                                ></div>

                                <div
                                    class="
                                    w-3 h-3 rounded-full
                                    bg-gradient-to-r
                                    from-[#9E111B]
                                    to-[#D14A4A]
                                    animate-bounce
                                    [animation-delay:0.3s]
                                    "
                                ></div>

                            </div>

                        </div>

                    </template>

                    {{-- Normal Message --}}
                    <template x-if="!message.loading">

                        <div

                            :class="
                                message.role === 'user'
                                ? 'bg-[#9E111B] text-white'
                                : 'bg-white text-[#3D3833] border border-[#EFE9E4]'
                            "

                            class="
                            max-w-[85%]
                            px-4
                            py-3
                            rounded-3xl
                            shadow-sm
                            "

                        >

                            <span x-text="message.content"></span>

                        </div>

                    </template>

                </div>

            </template>

        </div>

        </div>

        {{-- Footer --}}
        <div
            class="
            bg-white
            border-t
            border-[#EFE9E4]
            p-4
            "
        >

            <div
                class="
                flex
                items-center
                gap-2
                bg-[#F5F1EC]
                rounded-full
                px-3
                py-2
                "
            >

                <input
                    x-model="input"
                    @keydown.enter="sendMessage()"
                    type="text"
                    placeholder="Ask me anything sweet..."
                    class="
                    flex-1
                    bg-transparent
                    outline-none
                    text-sm
                    "
                >

                <button
                    @click="sendMessage()"
                    class="
                    w-10 h-10
                    rounded-full
                    bg-[#A8121D]
                    text-white
                    flex
                    items-center
                    justify-center
                    "
                >
                    ➤
                </button>

            </div>

        </div>

    </div>

</div>