burger = document.querySelector('.burger')
navbar = document.querySelector('.navbar')
rightnav = document.querySelector('.rightnav')
navlist = document.querySelector('.nav-list')

burger.addEventListener('click', ()=>{
    rightnav.classList.toggle('v-class-resp');
    navlist.classList.toggle('v-class-resp');
    navbar.classList.toggle('h-nav-resp');
})

  //update
  function toggleDropdown() {
    document.getElementById("interestsDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

document.querySelectorAll('#interestsDropdown input[type="checkbox"]').forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        updateSelectedInterests();
    });
});

function updateSelectedInterests() {
    var selectedInterests = [];
    document.querySelectorAll('#interestsDropdown input[type="checkbox"]:checked').forEach((checkbox) => {
        selectedInterests.push(checkbox.value);
    });
    document.getElementById("selectedInterests").value = selectedInterests.join(',');
}

function toggleDropdown() {
  document.getElementById("interestsDropdown").classList.toggle("show");
}

document.getElementById("registrationForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent default form submission
  // Your additional code logic here, if needed
});



function handleInterestSelection(checkbox) {
  // Handle the checkbox selection logic here
  // For example, you can store the selected interests in an array
  // You can also update the UI to reflect the selected interests
}




// Function to update selected interests and display them in the registration form
function updateSelectedInterests() {
  var selectedInterests = [];
  document.querySelectorAll('#interestsDropdown input[type="checkbox"]:checked').forEach((checkbox) => {
      selectedInterests.push(checkbox.value);
  });
  var selectedInterestsDisplay = document.getElementById("selectedInterestsDisplay");
  selectedInterestsDisplay.innerHTML = "Selected Interests: " + selectedInterests.join(', ');
  document.getElementById("selectedInterests").value = selectedInterests.join(',');
}

// Event listener to handle interest selection
document.querySelectorAll('#interestsDropdown input[type="checkbox"]').forEach((checkbox) => {
  checkbox.addEventListener('change', (event) => {
      updateSelectedInterests();
  });
});
