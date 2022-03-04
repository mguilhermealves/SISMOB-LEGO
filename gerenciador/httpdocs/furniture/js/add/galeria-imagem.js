var imgUpload = document.getElementById('imagens_galery')
  , imgPreview = document.getElementById('img_preview')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, false);
// imgUploadForm.addEventListener('submit', function (e) {
//   e.preventDefault();
//   alert('Images Uploaded! (not really, but it would if this was on your website)');
// }, false);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;
  
  if(!!totalFiles) {
    imgPreview.classList.remove('quote-imgs-thumbs--hidden');
    previewTitle = document.createElement('p');
    previewTitle.style.fontWeight = 'bold';
    previewTitleText = document.createTextNode(totalFiles + ' Imagens selcionadas');
    previewTitle.appendChild(previewTitleText);
    imgPreview.appendChild(previewTitle);
  }
  
  for(var i = 0; i < totalFiles; i++) {
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    imgPreview.appendChild(img);
  }
}

function deleteGalery(x){
   $(".galery_image"+x).remove();   
   $("#imagens_galery"+x).remove();
}