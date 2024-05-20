// Array to store selected values
var selectedValues = [];

// Options for the dropdown
var options = [
    "Java", "Python", "JavaScript", "C++", "Ruby", "Swift", "Go", "HTML", "CSS", "PHP", "TypeScript",
    "Rust", "Kotlin", "C#", "History", "Geography", "World Wars", "Famous Personalities", "Inventions",
    "Space Exploration", "Countries and Capitals", "Physics", "Chemistry", "Biology", "Astronomy", "Earth Sciences",
    "Scientific Discoveries", "Technology", "Algebra", "Geometry", "Calculus", "Statistics", "Number Theory",
    "Mathematical Formulas", "Logic", "Debugging", "Error Handling", "Common Programming Errors", "Troubleshooting",
    "javascript", "python", "java", "html", "css", "php", "android", "c++", "reactjs", "node.js", "git", "docker",
    "mysql", "mongodb", "json", "regex", "visual-studio-code", "machine-learning", "data-science",
    "artificial-intelligence", "algorithm", "software-engineering", "web-development", "frontend", "backend",
    "api", "security", "cloud-computing", "devops", "agile", "testing", "database", "networking",
    "programming-languages", "web-development", "software-engineering", "data-structures", "algorithms",
    "machine-learning", "artificial-intelligence", "cybersecurity", "cloud-computing", "entrepreneurship",
    "startups", "product-management", "career-advice", "technology-trends", "coding-interviews", "programming-jobs",
    "computer-science-education", "programming-tools", "coding-practices", "code-review", "programming-challenges"
];

function filterOptions() {
    var input = document.getElementById('textInput').value.toLowerCase();
    var dropdownList = document.getElementById('dropdownList');

    dropdownList.innerHTML = '';

    for (var i = 0; i < options.length; i++) {
        var value = options[i].toLowerCase();
        if (value.includes(input)) {
            dropdownList.innerHTML += '<div onclick="selectOption(\'' + options[i] + '\')">' + options[i] + '</div>';
        }
    }

    if (input !== '' && !options.some(option => option.toLowerCase() === input)) {
        dropdownList.innerHTML += '<div onclick="selectOption(\'' + input + '\')">' + input + '</div>';
    }

    if (dropdownList.innerHTML !== '') {
        dropdownList.style.display = 'block';
    } else {
        dropdownList.style.display = 'none';
    }
}

function selectOption(option) {
    if (!selectedValues.includes(option)) {
        selectedValues.push(option);
        updateSelectedValues();
        document.getElementById('textInput').value = '';
        document.getElementById('dropdownList').style.display = 'none';
    }
}

function removeSelectedValue(value) {
    selectedValues = selectedValues.filter(item => item !== value);
    updateSelectedValues();
}

function updateSelectedValues() {
    var selectedValuesContainer = document.getElementById('selectedValuesContainer');
    selectedValuesContainer.innerHTML = '';

    selectedValues.forEach(function (value) {
        var selectedValueElement = document.createElement('span');
        selectedValueElement.classList.add('selected-value');
        selectedValueElement.textContent = value;

        var removeBtn = document.createElement('span');
        removeBtn.classList.add('remove-btn');
        removeBtn.textContent = '✖';
        removeBtn.onclick = function () {
            removeSelectedValue(value);
        };

        selectedValueElement.appendChild(removeBtn);
        selectedValuesContainer.appendChild(selectedValueElement);
    });

    updateHiddenInput();
}

function updateHiddenInput() {
    var selectedValuesInput = document.getElementById('selectedValuesInput');
    selectedValuesInput.value = JSON.stringify(selectedValues);
}