 <div class="md:hidden space-y-4" x-data="{ openEdit: false }">
     @forelse ($expenses as $expense)
         <div
             class="bg-zinc-900 border-2 border-zinc-800 p-4 shadow-[4px_4px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition-all">
             <!-- Header do Card -->
             <div class="flex items-start justify-between gap-3 mb-3 pb-3 border-b border-zinc-800">
                 <div class="flex items-center gap-2 flex-1">
                     <div class="w-3 h-3 rounded-full {{ $expense->status === 'paid' ? 'bg-lime-400' : 'bg-red-500' }}">
                     </div>
                     <h3 class="font-bold text-white text-base">{{ $expense->title }}</h3>
                 </div>

                 <!-- Valor Destaque -->
                 <div class="text-right">
                     <span
                         class="text-xl font-black tabular-nums {{ $expense->type === 'expense' ? 'text-red-400' : 'text-lime-400' }}">
                         {{ $expense->type === 'expense' ? '- ' : '+ ' }}R$ {{ $expense->amount }}
                     </span>
                 </div>
             </div>

             <!-- Informações do Card -->
             <div class="space-y-2">
                 <!-- Status -->
                 <div class="flex items-center justify-between">
                     <span class="text-xs text-zinc-500 uppercase font-bold">Status</span>
                     @if ($expense->status === 'paid')
                         <span
                             class="inline-flex items-center gap-1 px-2 py-1 bg-lime-400/20 border border-lime-400 text-lime-400 text-xs font-black uppercase">
                             <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                 <path fill-rule="evenodd"
                                     d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                     clip-rule="evenodd" />
                             </svg>
                             Pago
                         </span>
                     @else
                         <span
                             class="inline-flex items-center gap-1 px-2 py-1 bg-red-500/20 border border-red-500 text-red-400 text-xs font-black uppercase">
                             <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                 <path fill-rule="evenodd"
                                     d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                     clip-rule="evenodd" />
                             </svg>
                             Pendente
                         </span>
                     @endif
                 </div>

                 <!-- Tipo -->
                 <div class="flex items-center justify-between">
                     <span class="text-xs text-zinc-500 uppercase font-bold">Tipo</span>
                     @if ($expense->type === 'expense')
                         <span class="inline-flex items-center gap-1 text-red-400 font-bold text-sm">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                             </svg>
                             Saída
                         </span>
                     @else
                         <span class="inline-flex items-center gap-1 text-lime-400 font-bold text-sm">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 10l7-7m0 0l7 7m-7-7v18" />
                             </svg>
                             Entrada
                         </span>
                     @endif
                 </div>

                 <!-- Categoria -->
                 <div class="flex items-center justify-between">
                     <span class="text-xs text-zinc-500 uppercase font-bold">Categoria</span>
                     <span
                         class="px-2 py-1 bg-zinc-950 border border-zinc-700 text-zinc-300 text-xs font-bold uppercase">
                         {{ $expense->category }}
                     </span>
                 </div>
             </div>
             <div class="flex gap-2 mt-3 pt-3 border-t border-zinc-800">
                 {{-- <button @click="openEdit = true"
                     class="flex-1 px-3 py-2 bg-zinc-900 border-2 border-zinc-700 text-zinc-300 hover:border-cyan-400 hover:text-cyan-400 text-xs font-black uppercase transition-all flex items-center justify-center gap-1">
                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                     </svg>
                     Editar
                 </button> --}}

                 @if ($expense->status === 'pending')
                     <form action="{{ route('api.expense.mark-as-paid', ['expense' => $expense->id]) }}" method="POST"
                         class="inline flex-1 w-full">
                         @csrf
                         @method('PUT')
                         <button type="submit"
                             class="flex-1 px-3 py-2 bg-lime-400/10 border-2 border-lime-400 text-lime-400 hover:bg-lime-400 hover:text-zinc-950 text-xs font-black uppercase transition-all flex items-center justify-center gap-1 w-full">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M5 13l4 4L19 7" />
                             </svg>
                             Pagar
                         </button>
                     </form>
                 @else
                     <form action="{{ route('api.expense.mark-as-pending', ['expense' => $expense->id]) }}"
                         method="POST" class="inline flex-1 w-full">
                         @csrf
                         @method('PUT')
                         <button type="submit"
                             class="flex-1 px-3 py-2 bg-red-500/10 border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-zinc-950 text-xs font-black uppercase transition-all flex items-center justify-center gap-1 w-full">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                             </svg>
                             Desfazer
                         </button>
                     </form>
                 @endif

                 <button @click="confirmDelete = true"
                     class="px-3 py-2 bg-zinc-900 border-2 border-zinc-700 text-zinc-400 hover:border-red-500 hover:text-red-500 text-xs font-black uppercase transition-all flex items-center justify-center">
                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                     </svg>
                 </button>
             </div>
         </div>

     @empty
         <div class="flex flex-col items-center gap-4 py-16">
             <div class="w-16 h-16 bg-zinc-900 border-4 border-zinc-800 flex items-center justify-center">
                 <svg class="w-8 h-8 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                 </svg>
             </div>
             <div class="text-center">
                 <p class="text-zinc-400 font-bold text-lg mb-1">Nenhuma transação encontrada</p>
                 <p class="text-zinc-600 text-sm">Adicione sua primeira transação para começar</p>
             </div>
         </div>
     @endforelse

 </div>
