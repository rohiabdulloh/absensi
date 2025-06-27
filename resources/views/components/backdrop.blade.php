<div
   x-transition:enter="transition duration-300 ease-in-out"
   x-transition:enter-start="opacity-0"
   x-transition:enter-end="opacity-100"
   x-transition:leave="transition duration-300 ease-in-out"
   x-transition:leave-start="opacity-100"
   x-transition:leave-end="opacity-0"
   x-show="{{$show}}"
   @click="{{$onclose}}"
   class="fixed inset-0 z-10 bg-black"
   style="opacity: 0.5"
   aria-hidden="true"
></div>