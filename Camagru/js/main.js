let width = 500;
let height = 0;
let filter = 'none';
let streaming = false;

const video = document.getElementById('video');
const photo = document.getElementById('photo');
const canvas = document.getElementById('canvas');
const gallery = document.getElementById('gallery');

navigator.mediaDevices.getUserMedia({video: true, audio: false})
  .then(function(stream)
  {
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err)
  {
    console.log(`Error: ${err}`);
  });

  video.addEventListener('canplay', function(e)
  {
    if(!streaming)
    {
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  photo.addEventListener('click', function(e)
  {
    take_photo();
    e.preventDefault();
  }, false);
  function take_photo()
  {
    const context = canvas.getContext('2d');
    if (width && height)
    {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);

      const imgUrl = canvas.toDataURL('image/png');
      const img = document.createElement('img');
      img.setAttribute('src', imgUrl);
      gallery.appendChild(img);
    }
  }
  /* Uploading an image using jQuery */
/*•••••••••••••••••••••••••••••••••••••••••••••••••
            USER PROFILE SETTINGS
••••••••••••••••••••••••••••••••••••••••••••••••••*/
function open_profile(evnt, tabname)
{
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabname).style.display = "block";
    evnt.currentTarget.className += " active";
}