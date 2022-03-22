function updateSelection(event_id, checkbox_id, category, i) {
            var FD = new FormData();
            FD.append('checked', document.getElementById(checkbox_id).checked);
            FD.append('event_id', event_id);
            FD.append('category', category);
            FD.append('i', i);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                if(res.checked == "true")
                  res.checked = true;
                else if(res.checked == "false")
                  res.checked = false;
                $('#' + checkbox_id).prop("checked", res.checked);
                checkStatusUpdate(event_id);
                location.reload();

              }
            };
            xhttp.open("POST", "updateFoodsAndServices.php", true);
            xhttp.send(FD);

          }

          function checkStatusUpdate(event_id) {
            var foods = document.getElementsByClassName('food');
            var beverages = document.getElementsByClassName('beverages');
            var other = document.getElementsByClassName('other');
            var equipment = document.getElementsByClassName('equipment');
            var foodStatus = true;
            var bevStatus = true;
            var otherStatus = true;
            var eqStatus = true;

            for (var i = 0; i < foods.length; i++) {
              if(!foods[i].checked)
                foodStatus = false;
            }

            for (var i = 0; i < beverages.length; i++) {
              if(!beverages[i].checked)
                bevStatus = false;
            }

            for (var i = 0; i < other.length; i++) {
              if(!other[i].checked)
                otherStatus = false;
            }

            for (var i = 0; i < equipment.length; i++) {
              if(!equipment[i].checked)
                eqStatus = false;
            }


            if(foods.length == 0)
              foodStatus = true;
            if(beverages.length == 0)
              bevStatus = true;
            if(other.length == 0)
              otherStatus = true;
            if(equipment.length == 0)
              equipmentStatus = true;


            var FD = new FormData();
            FD.append('event_id', event_id);

            if(foodStatus && bevStatus && otherStatus && eqStatus) {
              FD.append('progress', 'Completed');

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var res = JSON.parse(this.responseText);
                  // console.log(res);
                  location.reload();
                }
              };
              xhttp.open("POST", "updateProgress.php", true);
              xhttp.send(FD);
            }
            else {
              FD.append('progress', 'In Progress');

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var res = JSON.parse(this.responseText);
                  // console.log(res);
                  location.reload();
                }
              };
              xhttp.open("POST", "updateProgress.php", true);
              xhttp.send(FD);
            }
          }

          $(document).ready(function() {
            var foods = document.getElementsByClassName('food');
            var beverages = document.getElementsByClassName('beverages');
            var other = document.getElementsByClassName('other');
            var equipment = document.getElementsByClassName('equipment');
            var foodStatus = false;
            var bevStatus = false;
            var otherStatus = false;
            var eqStatus = false;

            var i, showLabel = true;
            if(foods.length > 0){
              for (i = 0; i < foods.length; i++) {
                if(!foods[i].checked)
                  showLabel = false;
              }
            }
            else
              showLabel = false;

            if(showLabel){
              foodStatus = true;
              document.getElementById('foodStatus').style.visibility = "visible";
            }
            else
              document.getElementById('foodStatus').style.visibility = "hidden";

            showLabel = true;
            if(beverages.length > 0){
              for (i = 0; i < beverages.length; i++) {
                if(!beverages[i].checked)
                  showLabel = false;
              }
            }
            else
              showLabel = false;

            if(showLabel){
              bevStatus = true;
              document.getElementById('bevStatus').style.visibility = "visible";
            }
            else
              document.getElementById('bevStatus').style.visibility = "hidden";


            showLabel = true;

            if(other.length > 0){
              for (i = 0; i < other.length; i++) {
                if(!other[i].checked)
                  showLabel = false;
              }
            }
            else
              showLabel = false;

            if(showLabel){
              otherStatus = true;
              document.getElementById('otherStatus').style.visibility = "visible";
            }
            else
              document.getElementById('otherStatus').style.visibility = "hidden";


            showLabel = true;
            if(equipment.length > 0){
              for (i = 0; i < equipment.length; i++) {
                if(!equipment[i].checked)
                  showLabel = false;
              }
            }
            else
              showLabel = false;
            if(showLabel){
              eqStatus = true;
              document.getElementById('eqStatus').style.visibility = "visible";
            }
            else
              document.getElementById('eqStatus').style.visibility = "hidden";
        });