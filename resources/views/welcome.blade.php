<x-layout.main-layout title="Fillament Wallet">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes com animação -->
        <div class="pointer-events-none fixed inset-0">
            <div
                class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12 transition-transform duration-[3000ms] hover:scale-110">
            </div>
            <div
                class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12 transition-transform duration-[3000ms] hover:scale-110">
            </div>
            <div
                class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6 transition-transform duration-[3000ms] hover:scale-110">
            </div>
        </div>

        <!-- Header -->
        <x-layout.header />

        <!-- Hero -->
        <section class="relative z-10 px-6 py-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <h2 class="text-5xl md:text-7xl lg:text-8xl font-extrabold leading-none uppercase">
                    Controle
                    <span class="block text-lime-400 mt-2">Financeiro</span>
                    <span
                        class="block text-zinc-400 text-2xl md:text-3xl mt-4 font-normal normal-case tracking-wide">sem
                        complicação</span>
                </h2>
                <p class="text-lg md:text-xl text-zinc-300 max-w-xl leading-relaxed">
                    O <strong class="text-lime-400">Filament Wallet</strong> é um gerenciador de contas que ajuda você a
                    acompanhar
                    pagamentos, recebimentos e a controlar seu saldo de forma clara e eficiente.
                    Registre suas transações e visualize o impacto real de cada movimento financeiro.
                </p>
                <div class="flex flex-wrap gap-6 pt-4">
                    <a href="{{ route('web.register') }}"
                        class="group bg-lime-400 text-zinc-950 px-10 py-5 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                        <span class="flex items-center gap-2">
                            Começar agora
                            <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                        </span>
                    </a>
                    <a href="{{ route('web.features') }}"
                        class="border-4 border-zinc-100 px-10 py-5 font-black uppercase hover:bg-zinc-100 hover:text-zinc-950 transition-all duration-200">
                        Ver recursos
                    </a>
                </div>
            </div>

            <!-- Visual block melhorado -->
            <div class="relative">
                <div
                    class="bg-zinc-900 border-4 border-zinc-100 p-8 shadow-[12px_12px_0_0_#000] hover:shadow-[8px_8px_0_0_#000] transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-6">
                        <p class="font-mono text-sm text-zinc-400 uppercase tracking-wider">Resumo financeiro</p>
                        <span class="text-xs px-3 py-1 bg-lime-400 text-zinc-950 font-bold uppercase">Atualizado</span>
                    </div>
                    <div class="space-y-5">
                        <div class="flex justify-between items-center font-bold group">
                            <span class="text-zinc-300">Total recebido</span>
                            <span
                                class="text-lime-400 text-xl tabular-nums group-hover:scale-110 transition-transform">R$
                                12.450</span>
                        </div>
                        <div class="flex justify-between items-center font-bold group">
                            <span class="text-zinc-300">Total gasto</span>
                            <span
                                class="text-red-400 text-xl tabular-nums group-hover:scale-110 transition-transform">R$
                                8.320</span>
                        </div>
                        <div class="h-1 bg-zinc-700 my-4"></div>
                        <div class="flex justify-between items-center text-2xl font-black pt-2">
                            <span>Saldo final</span>
                            <span class="text-cyan-400 tabular-nums">R$ 4.130</span>
                        </div>
                    </div>
                    <!-- Indicador visual -->
                    <div class="mt-6 pt-6 border-t border-zinc-800">
                        <div class="flex items-center gap-2 text-sm text-zinc-400">
                            <div class="w-2 h-2 bg-lime-400 rounded-full animate-pulse"></div>
                            <span>Dados em tempo real</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats rápidas -->
        <section class="relative z-10 px-6 py-16">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-zinc-900/50 border-2 border-zinc-800">
                    <div class="text-5xl font-black text-lime-400 mb-2">100%</div>
                    <div class="text-sm uppercase tracking-wider text-zinc-400">Gratuito</div>
                </div>
                <div class="text-center p-8 bg-zinc-900/50 border-2 border-zinc-800">
                    <div class="text-5xl font-black text-cyan-400 mb-2">∞</div>
                    <div class="text-sm uppercase tracking-wider text-zinc-400">Transações</div>
                </div>
                <div class="text-center p-8 bg-zinc-900/50 border-2 border-zinc-800">
                    <div class="text-5xl font-black text-fuchsia-500 mb-2">24/7</div>
                    <div class="text-sm uppercase tracking-wider text-zinc-400">Acesso</div>
                </div>
            </div>
        </section>

        <!-- Features com ícones e hover effects -->
        <section id="features" class="relative z-10 px-6 py-24 border-t-4 border-zinc-800">
            <div class="max-w-6xl mx-auto">
                <h3 class="text-4xl md:text-5xl font-black uppercase mb-4">O que o Filament faz</h3>
                <p class="text-lg text-zinc-400 mb-16 max-w-2xl">
                    Ferramentas essenciais para manter suas finanças organizadas
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="group border-4 border-zinc-100 p-8 bg-zinc-900 hover:bg-zinc-800 transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                            ✓
                        </div>
                        <h4 class="font-black text-xl uppercase mb-4 group-hover:text-lime-400 transition-colors">Contas
                            claras</h4>
                        <p class="text-zinc-300 leading-relaxed">
                            Cadastre contas de pagamento e recebimento com valores fixos ou variáveis.
                        </p>
                    </div>

                    <div
                        class="group border-4 border-zinc-100 p-8 bg-zinc-900 hover:bg-zinc-800 transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                            📊
                        </div>
                        <h4 class="font-black text-xl uppercase mb-4 group-hover:text-cyan-400 transition-colors">
                            Expectativas reais</h4>
                        <p class="text-zinc-300 leading-relaxed">
                            Veja quanto você <strong>espera gastar</strong> e <strong>espera receber</strong> antes do
                            mês acabar.
                        </p>
                    </div>

                    <div
                        class="group border-4 border-zinc-100 p-8 bg-zinc-900 hover:bg-zinc-800 transition-all duration-300 hover:-translate-y-2">
                        <div
                            class="w-14 h-14 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-2xl mb-6">
                            💰
                        </div>
                        <h4 class="font-black text-xl uppercase mb-4 group-hover:text-fuchsia-500 transition-colors">
                            Impacto final</h4>
                        <p class="text-zinc-300 leading-relaxed">
                            O sistema calcula o saldo final projetado com base nas suas decisões financeiras.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to action melhorado -->
        <section class="relative z-10 px-6 py-32 bg-zinc-100 text-zinc-950">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-4xl md:text-6xl font-black uppercase mb-6 leading-tight">
                    Pare de adivinhar.
                    <span class="block mt-2">Veja o dinheiro como ele é.</span>
                </h3>
                <p class="text-lg md:text-xl text-zinc-600 mb-12 max-w-2xl mx-auto">
                    Comece agora a ter controle total sobre suas finanças pessoais
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('web.register') }}"
                        class="inline-block bg-zinc-950 text-zinc-100 px-12 py-6 font-black uppercase shadow-[8px_8px_0_0_#000] hover:shadow-[3px_3px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all duration-200">
                        Criar minha carteira
                    </a>
                    <a href="{{ route('web.features') }}"
                        class="inline-block border-4 border-zinc-950 px-12 py-6 font-black uppercase hover:bg-zinc-950 hover:text-zinc-100 transition-all duration-200">
                        Explorar recursos
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
