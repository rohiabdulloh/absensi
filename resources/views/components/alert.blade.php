<div>
    <div  x-data="{isAlertShow:false, message:'', status: 'success'}"
        x-on:show-message.window="
            isAlertShow = true; 
            message = $event.detail.msg;
            status = $event.detail.status || 'success';
            console.log($event.detail);
        "
        x-init="$watch('isAlertShow', (value) => {
            if(value) setTimeout(() =>  isAlertShow = false , 2000);
        })"
    >
        <div
            x-transition:enter="transition duration-300 ease-in-out transform"
            x-transition:enter-start="-translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition duration-300 ease-in-out transform"
            x-transition:leave-start="opacity-80"
            x-transition:leave-end="opacity-0"
            x-show="isAlertShow"
            class="fixed right-0 md:right-3 top-0 md:top-16 z-20 w-full md:w-1/5 min-h-20"
        >
            <div class="flex items-center space-x-2 w-full p-2 h-full md:rounded-md shadow-xl opacity-80"
                :class="{
                    'bg-green-500' : status == 'success',
                    'bg-yellow-500' : status == 'warning',
                    'bg-red-500' : status == 'danger',
                }"
            >
                <div x-show="status=='success'"><x-fas-check-circle class="w-4 h-4 text-white"/></div>
                <div x-show="status=='warning'"><x-fas-exclamation-triangle class="w-4 h-4 text-white"/></div>
                <div x-show="status=='danger'"><x-fas-exclamation-circle class="w-4 h-4 text-white"/></div>

                <div class="flex-1 text-white" x-text="message"></div>

                <button type="button" @click="isAlertShow=false" >
                    <x-fas-times class="w-4 h-4 text-white"/>
                </button>
            </div>
        </div>
    </div>
</div>