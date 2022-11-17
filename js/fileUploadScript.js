let fileInput = document.querySelector(".fileInput");
let preview = document.querySelector(".preview"); 

fileInput.addEventListener('change', updateImageDisplay);

function updateImageDisplay() {
    while(preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }
  
    var curFiles = fileInput.files;
    if(curFiles.length === 0) {
        var para = document.createElement('p');
        para.textContent = 'Файл не выбран';
        preview.appendChild(para);
    } else {
        var list = document.createElement('ol');
        preview.appendChild(list);
        for(var i = 0; i < curFiles.length; i++) {
            var listItem = document.createElement('li');
            var para = document.createElement('p');
            if(validFileType(curFiles[i])) {
                para.textContent = 'Имя файла: ' + curFiles[i].name + ', file size ' + returnFileSize(curFiles[i].size) + '.';
                var image = document.createElement('img');
                image.src = window.URL.createObjectURL(curFiles[i]);
  
                listItem.appendChild(image);
                listItem.appendChild(para);
  
            } else {
                para.textContent = 'Имя файла: ' + curFiles[i].name + ': Неверный формат файла.';
                listItem.appendChild(para);
            }
  
            list.appendChild(listItem);
        }
    }
}

var fileTypes = [
        'image/jpeg',
        'image/pjpeg',
        'image/png'
    ]
  
function validFileType(file) {
    for(var i = 0; i < fileTypes.length; i++) {
        if(file.type === fileTypes[i]) {
            return true;
        }
    }
  
    return false;
}

function returnFileSize(number) {
    if(number < 1024) {
        return number + 'bytes';
    } else if(number > 1024 && number < 1048576) {
        return (number/1024).toFixed(1) + 'KB';
    } else if(number > 1048576) {
        return (number/1048576).toFixed(1) + 'MB';
    }
  }