
function addproduct() {
    window.location.href = "../products/add.web.php";
}

function addBrand() {
    window.location.href = "../brand/add.web.php";
}

function addUser() {
    window.location.href = "../user/add.web.php";
}

function addAdmin() {
    window.location.href = "../admin/add.web.php";

}
function searchProduct() {
    var searchTerm = document.getElementById('searchInput').value;

    // Send an AJAX request to the PHP file.
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../search/product.php?term=" + searchTerm, true);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Display the search results.
            document.getElementById('searchResults').innerHTML = this.responseText;
        }
    };
    xhr.send();
    // Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Function to update the modal with search results
function updateSearchResults(results) {
  // Get the table element
  var table = document.getElementById("searchResultsTable");

  // Clear any existing rows
  while (table.firstChild) {
    table.removeChild(table.firstChild);
  }

  // Add a new row for each result
  results.forEach(function(result) {
    var row = document.createElement("tr");

    // Add a new cell for each property of the result
    for (var property in result) {
      if (result.hasOwnProperty(property)) {
        var cell = document.createElement("td");
        cell.textContent = result[property];
        row.appendChild(cell);
      }
    }

    table.appendChild(row);
  });

  // Show the modal
  modal.style.display = "block";
}s
}


