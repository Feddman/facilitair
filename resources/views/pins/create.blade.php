<x-guest-layout>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <div class="mt-4 flex justify-center ">

        <div class="md:w-3/4 md:flex flex-row shadow-inner">

            <form method="post"  id="upload-form" class="dropzone w-full" action="{{route('pin.store')}}">
                 <h3 class="text-2xl">Nieuwe pin maken</h3>
                 <div id="errors" class="errors hidden">
                    <ul id="errorList" class="list-disc list-inside text-red-500">

                    </ul>
                 </div>
                @csrf
                <div class=" md:flex gap-4 justify-between">
                    <div class="uploadzone md:w-1/4">
                        <div class="p-8 dz-message border-black border-dashed border" data-dz-message><span>Upload jouw afbeeldingen</span></div>
                        <div class="dropzone-previews"></div>
                    </div>
                    <div class="fields md:w-3/4">
                         <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="title">
                              Titel
                            </label>
                            <input class=" cursor-pointer border border-gray-400 p-2 rounded-lg w-full" type="text" id="title" name="title">
                          </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="category">
                              Categorie
                            </label>
                            <select class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="category" name="category">
                                <option class="cursor-pointer" value=""></option>
                                @foreach($categories as $category)
                                    <optgroup label="{{$category->name}}">
                                        @foreach($category->subcategories as $sub)
                                            <option value="{{$sub->id}}">{{$sub->name}}</option>
                                        @endforeach
                                    </optgroup>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-4 md:w-1/2">
                               @livewire('tags.tag-input')
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Korte beschrijving <i><small>(gebruikt voor de voorkant van de pin)</small></i>
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="description" name="description"></textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="">
                                Naam school
                            </label>
                            <input class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="school_name" name="school_name">
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="">
                                Locatie school
                            </label>
                            <input class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="school_location" name="school_location">
                        </div>

                         <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="">
                                Datum gebruikname
                            </label>
                            <input class="border border-gray-400 p-2 rounded-lg w-full" type="date" id="datum_gebruikname" name="datum_gebruikname">
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                                Waarom ik deze pin wil laten zien
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="reden_bijzonderheid" name="reden_bijzonderheid"></textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Dit zeggen gebruikers erover
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="meningen" name="meningen"></textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Waar wordt het voornamelijk voor gebruikt?
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="primair_doel" name="primair_doel"></textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Zijn er bijzonderheden te melden?
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="bijzonderheden" name="bijzonderheden"></textarea>
                        </div>

                        <div class="mb-4 md:w-1/2">
                            <label class="block text-gray-700 font-medium mb-2" for="description">
                              Betrokkenen (leveranciers, ontwerpers, etc.)
                            </label>
                            <textarea rows="5" class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="betrokkenen" name="betrokkenen"></textarea>
                        </div>

                        <button type="submit" class="bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600">Opslaan</button>

                    </div>
                </div>


            </form>

            <script >
                Dropzone.options.uploadForm = { // The camelized version of the ID of the form element

                  // The configuration we've talked about above
                  autoProcessQueue: false,
                  uploadMultiple: true,
                  parallelUploads: 100,
                  maxFiles: 100,
                  addRemoveLinks: true,
                  previewsContainer: '.dropzone-previews',


                  // The setting up of the dropzone
                  init: function() {
                    var myDropzone = this;

                    // First change the button to actually tell Dropzone to process the queue.
                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                      // Make sure that the form isn't actually being sent.
                      e.preventDefault();
                      e.stopPropagation();
                      if( myDropzone.getQueuedFiles().length > 0 ) {
                        myDropzone.processQueue();
                      } else {
                        alert('geen afbeeldingen geselecteerd');
                      }
                    });

                    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                    // of the sending event because uploadMultiple is set to true.
                    this.on("sendingmultiple", function() {
                      // Gets triggered when the form is actually being sent.
                      // Hide the success button or the complete form.
                    });
                    this.on("successmultiple", function(files, response) {
                      // Gets triggered when the files have successfully been sent.
                      // Redirect user or notify of success.
                      window.location.href = '/pin/' + response.id;

                    });
                    this.on("errormultiple", function(files, response) {
                      // Gets triggered when there was an error sending the files.
                      // Maybe show form again, and notify user of error
                        console.log('there was an error', response);
                        // scroll to top
                        window.scrollTo(0, 0);
                        // show error message
                        document.getElementById('errors').classList.remove('hidden');
                        document.getElementById('errorList').innerHTML = '';

                        for( error in response.errors) {
                            document.getElementById('errorList').innerHTML += '<li>' + response.errors[error] + '</li>';
                        }
                    });
                  }
                }

            </script>
        </div>
    </div>
</x-guest-layout>
