<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="mx-auto max-w-4xl">

        <div class="py-3 pl-3 border-b">
            <h1 class="font-bold mt-1 sm:text-slate-900 text-3xl">Agregar Archivos</h1>
        </div>

        
        <div class="grid grid-cols-1">
            <div class=" bg-white lg:p-16 sm:p-10 p-16 ">
                <form action="{{route('files.store')}}" class="dropzone" method="POST" id="dropzone">
                    @csrf
                    <div class="previews"></div>
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="activity_id" value="{{$activity->id}}">

                </form>
                <p class="mt-5">
                <button id="submit-all" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mb-3">Guardar archivos</button>
                <a href="{{ route('activities.edit', $activity) }}" class="text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm sm:inline block w-full sm:w-auto px-5 py-2.5 text-center">Cancelar</a>
                </p>
            </div>
        </div>

    </div>

    <footer class="w-full max-w-container mx-auto border-t py-10 text-center text-sm text-gray-500 sm:flex sm:items-center sm:justify-center">
        <p>© <script type="text/javascript">var d = new Date(); document.write(d.getFullYear());</script> Combuexpress</p>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        Dropzone.options.dropzone = {
            dictDefaultMessage: "Arrastra los archivos al recuadro",
            autoProcessQueue: false,
            parallelUploads: 100,
            maxFiles:100,
            init:function(){
                var myDropZone = this;
                var submitButton = document.querySelector("#submit-all");
                submitButton.addEventListener('click', function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropZone.processQueue();
                });

                this.on("complete",function(){
                    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
                        var _this = this;
                        _this.removeAllFiles();
                        window.open("{{route('activities.edit', $activity)}}","_self"); 
                    }
                });

            }
            

        };
    </script>
</x-app-layout>