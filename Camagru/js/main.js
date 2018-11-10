let width     = 500;
let height    = 0;
let filter    = 'none';
let streaming = false;

const video   = document.getElementById('video');
const photo   = document.getElementById('photo');
const canvas  = document.getElementById('canvas');
const gallery = document.getElementById('gallery');
const panel   = document.getElementById('pre-edit');
const pose    = document.getElementById('pose');
const pfilter = document.getElementById('pf');

navigator.mediaDevices.getUserMedia({video: true, audio: false})
  .then(function(stream){
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err)
  {
    console.log(`Error: ${err}`);
  });

  video.addEventListener('canplay', function(e){
    if(!streaming){
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  photo.addEventListener('click', function(e){
    take_photo();
    e.preventDefault();
  }, false);

  function take_photo(){
    if (width && height){
      canvas.width  = width;
      canvas.height = height;
      const context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, width, height);
      const imgUrl = canvas.toDataURL('image/png');
      const img = document.createElement('img');
      img.setAttribute('src', imgUrl);
      panel.appendChild(img);
    }
  }

  /* Uploading an image using jQuery */
/*•••••••••••••••••••••••••••••••••••••••••••••••••
            USER PROFILE SETTINGS
••••••••••••••••••••••••••••••••••••••••••••••••••*/
function open_profile(evnt, tabname){
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

function add_superpose(color){
 /*  video.style.filter = color;
  pose.setAttribute("src", "./filters/bunny.png");
  pose.setAttribute("width", "300");
  pose.setAttribute("height", "300");
  video.appendChild(pose);
  console.log('Trying...'); */
  if (width && height){
    canvas.width  = width;
    canvas.height = height;
    pose.setAttribute("width", "300");
    pose.setAttribute("height", "300");
    const context = canvas.getContext('2d');
    context.drawImage(pose, 0, 0, width, height);
    const myPoseUrl = canvas.toDataURL('image/png');
    const myPose = document.createElement('img');
    myPose.setAttribute('src', myPoseUrl);
    gallery.appendChild(myPose);
  }
}