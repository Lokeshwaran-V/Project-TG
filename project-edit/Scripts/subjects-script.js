// Function to toggle dropdown content visibility
function toggleDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId);
    dropdownContent.classList.toggle("show");
}

// Function to select department and update selected department in subjects dashboard
function selectDepartment(department) {
    var departmentBtn = document.getElementById("dropdown-btn-department-subjects");
    departmentBtn.innerText = department;
    toggleDropdown("dropdown-content-department-subjects");
    document.getElementById("selected-department").innerText = "Selected Department: " + department;
}

// Function to select department
function selectDepartment(department) {
    var departmentBtn = document.getElementById("dropdown-btn-department-timetable");
    departmentBtn.innerText = department;
    toggleDropdown("dropdown-content-department-timetable");
    document.getElementById("selected-department-timetable").innerText = "Selected Department: " + department;
}


// Function to select year and update selected year in subjects dashboard
function selectYear(year) {
    var yearBtn = document.getElementById("dropdown-btn-year-subjects");
    yearBtn.innerText = year;
    toggleDropdown("dropdown-content-year-subjects");
    document.getElementById("selected-year").innerText = "Selected Year: " + year;
}

// Function to view subjects
function viewSubjects() {
    var selectedDepartment = document.getElementById("selected-department").innerText.split(": ")[1];
    var selectedYear = document.getElementById("selected-year").innerText.split(": ")[1];

    console.log("Viewing subjects for Department:", selectedDepartment, "Year:", selectedYear);
}
