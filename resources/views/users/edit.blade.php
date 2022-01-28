<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" style="margin-top: 30px">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @if ( ($avatars = $user->getMedia('avatars'))->count() > 0)
            <img src="{{$user->getMedia('avatars')->last()->getUrl('medium')}}" alt="Avatar">
            @else
            <img src="/generic_avatar.png" alt="avatar">
            @endif
            <div style="margin-left: 20px">
                <h1 style="color:black;font-size:30px; margin-left:10px">
                    {{$user->name}}
                </h1>
                <h2 style="color:darkgray;font-size:20px; margin-left:10px">
                    {{$user->email}}
                </h2>
            

                <form action="/users/update/{{$user->id}}" method="post" enctype='multipart/form-data' class="ml-4 text-lg leading-7 font-semibold" style="margin-top: 10px">
                    @csrf
                    
                    <label for="name">Change name: </label>
                    <input type="text" name="name"/>
                                    
                    <br>
                    <br>
                            
                    <label style="margin-top: 10px" for="avatar"> Change Avatar (Profile picture): </label> 
                    <input type="file" name="avatar" id="avatar" accept="image/*"/>
                                
                    
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <button type="submit" class="flex items center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <div class="ml-4 text-lg leading-7 font-semibold">
                                            Save
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>


            </div>
        </div>

      

    </div>



</x-app-layout>