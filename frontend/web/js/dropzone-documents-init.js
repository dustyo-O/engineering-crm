function initDocumentsDropzone(dropzoneName, documents, uploadUrl, downloadUrl, csrf) {

    var elementName = 'div.' + dropzoneName + '-documents';
    var dropzone = new Dropzone(elementName, {
        url: uploadUrl,
        paramName: 'Documents[file]',
        sending: function(file, xhr, formData) {
            formData.append('_csrf-frontend', csrf);
        },
        success: function(file, response) {
            if (response) {
                $(elementName).closest('form').append(
                    $('<input/>', {
                        type: 'hidden',
                        name: dropzoneName.slice(0,1).toUpperCase() + dropzoneName.slice(1) + 'Documents[][id]',
                        value: response.id
                    })
                );
            }

            file.previewElement.onclick = function() {
                // TODO find download iframe better
                $('.download-file').prop('src', ''.concat(downloadUrl + (file.id || response.id)));
            }
        }
    });

    if (documents) {
        documents.forEach(
            function(document) {
                dropzone.emit("addedfile", document);
                dropzone.emit("success", document);
                dropzone.emit("complete", document);
            }
        );
    }

    return dropzone;
}