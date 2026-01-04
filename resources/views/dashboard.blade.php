<x-layout.main-layout title="Dashboard">
    <div class="min-h-screen relative overflow-hidden">

        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
            <div class="absolute bottom-0 left-1/4 w-[50rem] h-[20rem] bg-cyan-400/10 skew-y-6"></div>
        </div>

        <!-- Header -->
        <x-layout.header />


        <!-- Financial Summary -->
        <!-- Financial Summary -->
        <section class="relative z-10 px-6 py-16">
            <h2 class="text-4xl font-black text-white uppercase mb-8">Resumo Financeiro</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Recebido</p>
                    <p class="text-lime-400 text-2xl font-black mt-2">{{ $stats['total_receive'] }}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Total Gasto</p>
                    <p class="text-red-400 text-2xl font-black mt-2">{{ $stats['total_expense']}}</p>
                </div>
                <div class="border-4 border-zinc-100 p-6 bg-zinc-900 shadow-[12px_12px_0_0_#000]">
                    <p class="font-bold uppercase text-zinc-300">Saldo Esperado</p>
                    <p class="text-cyan-400 text-2xl font-black mt-2">{{ $stats['expected_total']}}</p>
                </div>
            </div>

            <!-- Acessar Dashboard -->
            <div class="flex justify-center">
                <a href="{{ route('filament.admin.pages.wallet-dashboard') }}"
                    class="bg-cyan-400 text-zinc-950 px-8 py-4 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                    Acessar Dashboard
                </a>
            </div>
        </section>

        <!-- Expenses List -->
        <section class="relative z-10 px-6 py-16">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-3xl font-black text-white uppercase">Despesas Recentes</h3>
                <button
                    class="bg-lime-400 text-zinc-950 px-6 py-3 font-black uppercase shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] transition">
                    + Nova Despesa
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-zinc-100 font-black uppercase border-b border-zinc-700">
                            <th class="text-left px-4 py-2">Descrição</th>
                            <th class="text-left px-4 py-2">Categoria</th>
                            <th class="text-left px-4 py-2">Data Vencimento</th>
                            <th class="text-left px-4 py-2">Data Pagamento</th>
                            <th class="text-right px-4 py-2">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-200">
                        @foreach ($expenses as $expense)
                            <tr class="border-b border-zinc-700 hover:bg-zinc-800 transition">
                                <td class="px-4 py-2">{{ $expense->title }}</td>
                                <td class="px-4 py-2">{{ $expense->category}} </td>
                                <td class="px-4 py-2">{{ $expense->due_date }}</td>
                                <td class="px-4 py-2">{{ $expense->payment_date }} </td>
                                <td class="px-4 py-2 text-right text-green-400 font-bold">{{ $expense->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>
