function showPatients(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        avators(JSON.parse(xmlhttp.responseText));
      }
    };
    if (str.length == 0) {
      xmlhttp.open("GET", "getAll.php", true);
    }else{
      xmlhttp.open("GET", "getPatients.php?q=" + str, true);
    }
    xmlhttp.send();


    function avators(a){
      for(i=0;i<8;i++){
        var n = "#a"+(i+1);
        $(n).show();
        $(n).css("display","inline-block");
        if(a[i]==null){
          $(n).hide();
        }
        else{
          var p = "p"+(i+1);
          var name = a[i][0] + " " + a[i][1];
          document.getElementById(p).innerHTML = name;
          var l = "#l"+(i+1);
		  var j = "#j"+(i+1); // new
          var patient = "topicPage.php?patientID="+a[i][2];
          $(l).attr("href", patient);
		  if(a[i][3]!=""){                             ///////////////
			  var img = "profile_picture/"+a[i][3];    ///// new /////
			  $(j).attr("src",img);                    ///////////////
		  }

        }
      }
    }

}
