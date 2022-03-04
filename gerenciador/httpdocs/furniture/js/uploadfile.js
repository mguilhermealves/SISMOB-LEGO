
// File Upload
// 
function ekUploadCustom(complement){
    function Init() {
  console.log(complement);
      console.log("Upload Initialised");
  
      var fileSelect    = document.getElementById('file-upload_'+complement),
          fileDrag      = document.getElementById('file-drag_'+complement),
          submitButton  = document.getElementById('submit-button');
  
      fileSelect.addEventListener('change', fileSelectHandler, false);
  
      // Is XHR2 available?
      var xhr = new XMLHttpRequest();
      if (xhr.upload) {
        // File Drop
        fileDrag.addEventListener('dragover', fileDragHover, false);
        fileDrag.addEventListener('dragleave', fileDragHover, false);
        fileDrag.addEventListener('drop', fileSelectHandler, false);
      }
    }
  
    function fileDragHover(e) {
      var fileDrag = document.getElementById('file-drag_'+complement);
  
      e.stopPropagation();
      e.preventDefault();
  
      fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload_'+complement);
    }
  
    function fileSelectHandler(e) {
      // Fetch FileList object
      var files = e.target.files || e.dataTransfer.files;
  
      // Cancel event and hover styling
      fileDragHover(e);
  
      // Process all File objects
      for (var i = 0, f; f = files[i]; i++) {
        parseFile(f);
        uploadFile(f);
      }
    }
  
    // Output
    function output(msg) {
      // Response
      var m = document.getElementById('messages_'+complement);
      m.innerHTML = msg;
    }
  
    function parseFile(file) {
  
      console.log(file.name);
      output(
        '<strong>' + encodeURI(file.name) + '</strong>'
      );
      
      // var fileType = file.type;
      // console.log(fileType);
      var imageName = file.name;
  
      var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
      if (isGood) {
        document.getElementById('start_'+complement).classList.add("hidden");
        document.getElementById('response_'+complement).classList.remove("hidden");
        document.getElementById('notimage_'+complement).classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file-image_'+complement).classList.remove("hidden");
        document.getElementById('file-image_'+complement).src = URL.createObjectURL(file);
      }
      else {
        document.getElementById('file-image_'+complement).classList.add("hidden");
        document.getElementById('notimage_'+complement).classList.remove("hidden");
        document.getElementById('start_'+complement).classList.remove("hidden");
        document.getElementById('response_'+complement).classList.add("hidden");
        document.getElementById("file-upload-form_"+complement).reset();
      }
    }
  
    function setProgressMaxValue(e) {
      var pBar = document.getElementById('file-progress_'+complement);
  
      if (e.lengthComputable) {
        pBar.max = e.total;
      }
    }
  
    function updateFileProgress(e) {
      var pBar = document.getElementById('file-progress_'+complement);
  
      if (e.lengthComputable) {
        pBar.value = e.loaded;
      }
    }
  
    function uploadFile(file) {
  
      var xhr = new XMLHttpRequest(),
        fileInput = document.getElementById('class-roster-file_'+complement),
        // pBar = document.getElementById('file-progress_'+complement),
        fileSizeLimit = 1024; // In MB
      if (xhr.upload) {
        // Check if file is less than x MB
        if (file.size <= fileSizeLimit * 1024 * 1024) {
          // Progress bar
         //pBar.style.display = 'inline';
        //   xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
        //   xhr.upload.addEventListener('progress', updateFileProgress, false);
  
          // File received / failed
          xhr.onreadystatechange = function(e) {
            if (xhr.readyState == 4) {
              // Everything is good!
  
              // progress.className = (xhr.status == 200 ? "success" : "failure");
              // document.location.reload(true);
            }
          };
  
          // Start upload
        //   xhr.open('POST', document.getElementById('file-upload-form').action, true);
        //   xhr.setRequestHeader('X-File-Name', file.name);
        //   xhr.setRequestHeader('X-File-Size', file.size);
        //   xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        //   xhr.send(file);
        } else {
          output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
        }
      }
    }
  
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
      Init();
    } else {
      document.getElementById('file-drag_'+complement).style.display = 'none';
    }
  }