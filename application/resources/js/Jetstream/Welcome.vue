<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-8 text-2xl">
                Bem vindo ao teste back-end developer feito por <a target="_blank" href="https://github.com/jpaulolxm">@jpaulolxm</a>.
            </div>

            <div class="mt-6 text-gray-500">
                Gerenciamento de contratos facilitado.<br>
                Assuma o controle de seus contratos de forma inteligente e automatizada.
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-4">

            <div class="p-6">
                <div class="flex items-center">
                    <img src="/img/facebook.png" alt="facebook">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a target="_blank" href="https://www.facebook.com/Accordous">facebook</a>
                    </div>
                </div>


            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <img src="/img/instagram.png" alt="instagram">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a target="_blank" href="https://www.instagram.com/accordous/">Instagram</a>
                    </div>
                </div>


            </div>

            <div class="p-6 border-t border-gray-200">
                <div class="flex items-center">
                    <img src="/img/linkedin.png" alt="linkedin">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a target="_blank" href="https://www.linkedin.com/company/accordous/">Linkedin</a>
                    </div>
                </div>


            </div>

            <div class="p-6 border-t border-gray-200 md:border-l">
                <div class="flex items-center">
                    <img src="/img/youtube.png" alt="Youtube">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a target="_blank" href="https://www.youtube.com/channel/UCd5e1Ly0tGNg2RMopNyKKyQ">Youtube</a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
