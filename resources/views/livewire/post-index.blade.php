<div class="max-w-6xl mx-auto ">
    <div class="flex justify-end m-2 p-2">
        <x-jet-button wire:click="ShowPostModal">
            create
        </x-jet-button>
    </div>
    <div class="m-2 p-2">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr style="background-color:white;">
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        title
                                    </th>

                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Image
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img class="w-8 h-8 rounded-full" src="{{asset('storage/app/public/posts'). '/' . $post->image }}"
                                                alt="">
                                        </td>
                                        <td class="px-6 py-4 text-begin text-sm ">
                                            <div class="flex space-x-2">
                                                <x-jet-button wire:click="showEditPostModal ({{ $post->id }})">
                                                Edit
                                            </x-jet-button>
                                            <div class="flex space-x-2">
                                                <x-jet-button class="bg-red-400 hover:bg-red-600" wire:click="deletePost ({{ $post->id }})">
                                                Delete
                                            </x-jet-button>

                                                </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>
    <div>
        <x-jet-dialog-modal wire:model="showingPostModal">
            @if ($isEditMode)
                <x-slot name="title">update post</x-slot>
            @else
                <x-slot name="title">create post</x-slot>
            @endif
            <x-slot name="content">

                    <div class="block p-1 rounded-lg shadow-lg bg-white max-w-md">
                        <form enctype="multipart/form-data">
                            <div class="form-group mb-6">
                                <label for="title" class="form-label inline-block mb-2 text-gray-700"> title
                                    <input type="text" name="title" wire:model.lazy="title"
                                        class="form-control block
                          w-full
                          px-3
                          py-1.5
                          text-base
                          font-normal
                          text-gray-700
                          bg-white bg-clip-padding
                          border border-solid border-gray-300
                          rounded
                          transition
                          ease-in-out
                          m-0
                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="exampleInput7" placeholder="Name">
                            </div>
                            @error('title')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror

                            <div class="form-group mb-6">
                                @if ($oldImage)
                                    old Image:
                                    <img src="{{ Storage::url($oldImage) }}">
                                @endif
                                @if ($image)
                                    Photo Preview:
                                    <img src="{{ $image->temporaryUrl() }}">
                                @endif
                                <div class="mb-3 w-96">
                                    <label for="formFile" class="form-label inline-block mb-2 text-gray-700"> file
                                        input</label>
                                    <input
                                        class="form-control
                                    block
                                    w-full
                                    px-3
                                    py-1.5
                                    text-base
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        name="image" wire:model="image" type="file" id="formFile">
                                </div>
                            </div>
                            @error('image')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror

                            <div class="form-group mb-6">
                                <label for="formFile" class="form-label inline-block mb-2 text-gray-700"> body</label>
                                <textarea
                                    class="
                          form-control
                          block
                          w-full
                          px-3
                          py-1.5
                          text-base
                          font-normal
                          text-gray-700
                          bg-white bg-clip-padding
                          border border-solid border-gray-300
                          rounded
                          transition
                          ease-in-out
                          m-0
                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                        "
                                    name="body" wire:model.lazy="body" id="exampleFormControlTextarea13" rows="3" placeholder="Message"></textarea>
                            </div>
                            @error('body')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror


                        </form>
                    </div>
                </form>
            </x-slot>
            <x-slot name="footer">
                @if ($isEditMode)
                    <x-jet-button wire:click="UpdatePost">update</x-jet-button>
                @else
                    <x-jet-button wire:click="storePost">store</x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
