/* // Define color variables:
red = [0, 100, 63];
orange = [40, 100, 60];
green = [75, 100, 40];
blue = [196, 77, 55];
purple = [280, 50, 60];
letterColors = [red, orange, green, blue, purple];

// This variable controls the smallest distance at which a mouse will 
mouseResponseThreshold = 50;

// This variable controls how strongly the dots will try to return to their starting position
friction = 0.85;

// This variable controls how much the dots will rotate when interacting
rotationForce = 0.0;

message = 'Change the physics!';

drawName(message, letterColors);
bounceBubbles(); */

let myImage = document.querySelector('img');

myImage.addEventListener('click', function() {
    let mySrc = myImage.getAttribute('src');
    if (mySrc === 'images/firefox-icon.png') {
      myImage.setAttribute('src', 'images/dz.png');
    } else {
      myImage.setAttribute('src', 'images/firefox-icon.png');
    }
});
let myButton = document.querySelector('button');
let myHeading = document.querySelector('h1');

function setUserName() {
  let myName = prompt('Veuillez saisir votre nom.');
  localStorage.setItem('nom', myName);
  myHeading.textContent = 'Mozilla est cool, ' + myName;
} if (!localStorage.getItem('nom')) {
  setUserName();
} else {
  let storedName = localStorage.getItem('nom');
  myHeading.textContent = 'Mozilla est cool, ' + storedName;
}
myButton.addEventListener('click', function() {
  setUserName();
});

