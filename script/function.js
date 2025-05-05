// JavaScript to handle click effect
document.querySelectorAll(".side li").forEach(item => {
    item.addEventListener("clicked", function() {
        // Remove 'clicked' from all items
        document.querySelectorAll(".side li").forEach(li => li.classList.remove("clicked"));

        // Add 'clicked' class to the clicked item
        this.classList.add("clicked");
    });
});


document.getElementById('school').addEventListener('change', function() {
    if (this.value === "") {
      alert("Please select a valid level.");
    }
  });
   // Number Only Input
  document.getElementById("phone").addEventListener("input", function (e) {
    this.value = this.value.replace(/\D/g, ""); // Removes non-numeric characters
  });
 
  // Live search functionality
  const searchInput = document.getElementById("searchInput");
  const table = document.getElementById("scholarTable");
  const rows = table.getElementsByTagName("tr");

  searchInput.addEventListener("keyup", function() {
      const filter = searchInput.value.toLowerCase();

      // Loop through all table rows (skip the first row with headers)
      for (let i = 1; i < rows.length; i++) {
          const cells = rows[i].getElementsByTagName("td");
          const nameCell = cells[0]; // The first column is "Name"
          
          if (nameCell) {
              const nameText = nameCell.textContent || nameCell.innerText;
              if (nameText.toLowerCase().indexOf(filter) > -1) {
                  rows[i].style.display = "";
              } else {
                  rows[i].style.display = "none";
              }
          }
      }
  });