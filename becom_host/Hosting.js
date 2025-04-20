//----------------disale ENTER from submitting-----------------------------------------------
function validateForm(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      // Your custom form submission logic here (e.g., validate data before submitting)
      return false; // Explicitly return false to prevent submission
    }
    return true; // Allow submission if not Enter key
  }
  //****************************** disale ENTER from submitting*****************************

// --------------------------------ADDING PICS---------------------------------------------------
// --------------------------------ADDING PICS---------------------------------------------------
// --------------------------------ADDING PICS---------------------------------------------------

function add_pic(pos, input) {
    var imported_pic = input.files[0];
    if (imported_pic) {
        let reader = new FileReader();

        reader.onload = function (e) {
            var img = new Image();
            img.src = e.target.result;
            img.onload = function () {
                var image = document.getElementById("tswira" + pos);
                if (image) {
                    image.src = img.src;
                }
            };
        };

        reader.readAsDataURL(imported_pic);
    }
}

function remove_pic(pos, inputElement) {
    var image = document.getElementById("tswira" + pos);
    if (image) {
        image.src = "";
    }
    var parentDiv = inputElement.closest('.pic');
    var inputFile = parentDiv.querySelector('input[type="file"]');
    if (inputFile) {
        inputFile.value = "";
        add_pic(pos, inputFile);
    }
}

// ********************************************ADDING PICS******************************************************************
// ********************************************ADDING PICS******************************************************************
// ********************************************ADDING PICS******************************************************************
var translate = 0;
function test_input() {
    let pg_nbr = -translate / 100;
    let page_elements = document.getElementsByClassName("page")[pg_nbr].getElementsByTagName("input");
    if (pg_nbr == 3) {
        let tsawer = document.getElementById("first-pic");
        if (tsawer.files.length == 0) {
            
            return 0;
        }
        else {
            return 1;
        }

    }
    for (let index = 0; index < page_elements.length; index++) {
        if (page_elements[index].value == "") {

            return 0;
        }
    }
    return 1;

}



// --------------------------------SLIDING PAGES---------------------------------------------------
// --------------------------------SLIDING PAGES---------------------------------------------------
// --------------------------------SLIDING PAGES---------------------------------------------------
document.getElementById("next").addEventListener('click',function(e) {
    e.preventDefault();
    slide('next');
})
document.getElementById("prev").addEventListener('click',function(e) {
    e.preventDefault();
    slide('prev');
})
function slide(direction) {
    
    let progress = document.getElementsByClassName("step1");
    if (direction == "next") {
        if (test_input() == 0) return;
        translate -= 100;

        let index = -translate / 100;
        progress[index - 1].style.background = "green";
    }
    else {
        translate += 100;
        let index = -translate / 100;
        progress[index].style.background = "transparent";
    }

    let pages = document.getElementsByClassName("page");
    // document.getElementById("text").innerHTML=`translate: ${translate}`;
    if (translate == -400) {
        document.getElementById("next").style.display = "none";
        document.getElementById("done").style.display = "inline-block";
    }
    else if (translate == 0) document.getElementById("prev").style.display = "none";
    else {
        document.getElementById("next").style.display = "inline-block";
        document.getElementById("prev").style.display = "inline-block";
        document.getElementById("done").style.display = "none";
    }
    for (let index = 0; index < pages.length; index++) {
        const element = pages[index];
        element.style.transform = `translateX(${translate}%)`;
    }
}

// ********************************************SLIDING PAGES******************************************************************
// ********************************************SLIDING PAGES******************************************************************
// ********************************************SLIDING PAGES******************************************************************


document.getElementById('input1').addEventListener('input', function (e) {
    e.preventDefault();
    let val = Number(this.value); // ensure you're not accidentally comparing strings
    if (val > 10000000) {
        this.value = 10000000;
    } else if (val < 0) {
        this.value = 0;
    }
});