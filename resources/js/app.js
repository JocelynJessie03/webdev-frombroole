import Chart from 'chart.js/auto';
import Alpine from 'alpinejs';

window.chatWidget = function () {
    return {
        open: false,

        input: '',

        messages: [
            {
                id: 1,
                role: 'assistant',
                content: 'Welcome to From Broole ✨'
            }
        ],

         init() {

            this.$watch('messages', () => {

                this.scrollToBottom();

            });

        },

        scrollToBottom() {

            this.$nextTick(() => {

                if (this.$refs.chatContainer) {

                    this.$refs.chatContainer.scrollTop =
                        this.$refs.chatContainer.scrollHeight;

                }

            });

        },

        async sendMessage() {

            if (!this.input.trim()) return;

            let userMessage = this.input;

            // USER MESSAGE
            this.messages.push({
                id: Date.now(),
                role: 'user',
                content: userMessage
            });

            this.input = '';

            // loading
            this.messages.push({
                id: 'loading',
                role: 'assistant',
                loading: true
            });

            try {

                const response = await fetch('/ai-chat', {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .content

                    },

                    body: JSON.stringify({

                        message: userMessage

                    })

                });

                const data = await response.json();

                // after loading
                this.messages =
                    this.messages.filter(
                        msg => msg.id !== 'loading'
                    );

                this.messages.push({

                    id: Date.now() + 1,

                    role: 'assistant',

                    content: data.reply

                });

            } catch (error) {

                this.messages.push({

                    id: Date.now() + 1,

                    role: 'assistant',

                    content: 'Sorry, something went wrong.'

                });

            }
            finally {

                this.messages =
                    this.messages.filter(
                        msg => msg.id !== 'loading'
                    );

            }

        }

    };
};

window.Alpine = Alpine;

Alpine.start();