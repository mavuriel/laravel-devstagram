import {Dropzone} from "dropzone";
// Si se coloca aquí y el css principal mediante link, esta lo sobreescribe
// import 'dropzone/dist/dropzone.css'
// Tendría que agregarse el css principal al final para evitarlo
// import '../css/app.css'

const dropzone = new Dropzone('#dropzone', {
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictDefaultMessage: 'Sube tu archivo',
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {

        const inputImage = document.querySelector('#image-path')
        if (inputImage?.value.trim()) {
            const publishImage = {
                size: 1234,
                name: inputImage.value
            }

            this.options.addedfile.call(this, publishImage)

            this.options.thumbnail.call(this, publishImage, `/uploads/${publishImage.name}`)

            publishImage.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
})

dropzone.on('sending', function (file, xhr, formData) {
    console.log({file})
})

dropzone.on('success', function (file, response) {
    console.log({response})
    document.querySelector('#image-path').value = response.image
})

dropzone.on('error', function (file, message) {
    console.log({message})
})

dropzone.on('removedfile', function () {
    console.log('Eliminado')
    // TODO: obtener/eliminar foto de forma correcta
    document.querySelector('#image-path').value = ''
})
