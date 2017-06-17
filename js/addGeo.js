$(document).ready(function(){
	console.log("ADD GEO READY");
	
	$("#createButton").button();

	//Hilight the whole row when the user hovers over it    
	$("#listLocations td").hover(
		onRowHover,onRowLeave
	);

	//initialize the dialog popup window
	$("#locationPopup").dialog({autoOpen : false,
		modal : true,
		width: '484',
		height: '600',
		show : "blind",
		hide : "blind",
		open: function() {
			$('.ui-widget-overlay').bind('click', function (){
				$('#locationPopup').dialog('close');
			})
		}
	});

	$("#listLocations td").click(function(){
		//obtain the primary key of the location user clicked on
		var id =$(this).parent().children()[0].textContent;
		displayLocationDetails(id);//display a popup giving more information on the location the user clicked on
	});

	//Logic for when the user clicked the create geocache button
	$("#createButton").click(function(){
		$("#createPopup").dialog({autoOpen : false,
			modal : true,
			width: '260',
			height: '600',
			show : "blind",
			hide : "blind",
			open: function() {
				$('.ui-widget-overlay').bind('click', function (){
					$('#createPopup').dialog('close');
				})
			}
		});

		var tempString = "";

		tempString += "<content>";
		tempString += '<form id="addLocationForm" onsubmit="return submitAddLocation()"'; //method="POST" action="php/addLocation.php">';
		tempString += '<b>Name:</b> <input type="text" id="addName" name="name"></input> </br>';
		tempString += '</br><b>Latitude: </b> <input id="addLat" type="text" name="latitude"></input> </br>';
		tempString += '</br><b>Longitude: </b> <input type="text" id="addLong" name="longitude"></input> </br>';
		tempString += '</br><b>City:</br> </b> <input type="text" id="addCity" name="city"></input> </br>';
		tempString += '</br><b>Country: </b> <input type="text" id="addCountry" name="country"></input> </br>';
		tempString += '</br><b>Difficulty: </b> </br><select id="addDiff"> <option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select> </br>';
		tempString += '</br><b>Rating: </b> </br><select id="addRating"> <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select> </br>';
		tempString += '<br>Image: </b> <input type="file" id="fileToUpload" name="fileToUpload" accept="image/gif, image/jpeg, image/png"></br>';
		tempString += '</br><button id="addLocationButton" class="hvr-pulse">Add</button>';
		tempString += "<div id='addError'></div>";
		tempString += "</form>";
		//tempString += '<button id="testButton">Test</button>';
		tempString += "</content>";

		$("#createPopup").empty();
		$("#createPopup").append(tempString);

		$("#createPopup").parent().find("span.ui-dialog-title").html("Create Geocache");

		$("#createPopup").dialog("open");
		$("#addLocationButton").button();

		//temp
		$("#testButton").button().click(function(){
			submitImage();
		});
	});
});

//Functions that control what happens when the user hovers over each row of the locations table
//while the mouse is on the row
function onRowHover(){ 
	var $trElement = $(this).parent();
	$trElement.children().each(function(){
		$(this).addClass("hover");
	});	
}
//when the mouse leaves the row
function onRowLeave(){
	var $trElement = $(this).parent();
	$trElement.children().each(function(){
		$(this).removeClass("hover");
	});	    
}

function displayLocationDetails(id){
	$.post( "php/getlocationJson.php", { location_id: id})
		.done(function( json ) {
			//DEBUG OUTPUT
			/*
			   console.log( "AJAX RESPONSE:");
			   console.log(json.location_id);
			   console.log(json.name);
			   console.log(json.latitude);
			   console.log(json.longatude);
			   console.log(json.city);
			   console.log(json.country);
			   console.log(json.difficulty);
			   console.log(json.rating);
			   console.log(json.img_url);
			 */

			var tempString = "";
			//tempString += "<p>" + json.location_id+ "</p>"; //hide the location primary key
			//		tempString += "<h1>" + json.name + "</h1>";
			tempString += "<content>";
			tempString += "<b>Latitude: </b>" + json.latitude+ "</br>";
			tempString += "<b>Longitude: </b>" + json.longatude+ "</br>";
			tempString += "<b>City: </b>" + json.city+ "</br>";
			tempString += "<b>Country: </b>" + json.country+ "</br>";
			tempString += "<b>Difficulty: </b>" + json.difficulty+ "</br>";
			tempString += "<b>Rating: </b>" + json.rating;
			tempString += "</content>"; //close #summaryContainer
			tempString += "<img alt='location image' src=" + json.img_url + "></img>";
			tempString += "<div id='map'></div>";

			//remove any existing html in the dialog box
			$("#locationPopup").empty();
			$("#locationPopup").append(tempString);

			//set the dialog title
			$("#locationPopup").parent().find("span.ui-dialog-title").html(json.name);
			
			//open up the dialog
			$("#locationPopup").dialog("open");

			//clear the map		
			$("#map").empty();

			//set the cooridnates
			var myLatLng = {lat: parseFloat(json.latitude), lng: parseFloat(json.longatude)};
			//load the map into the #map div
			var map = new google.maps.Map(document.getElementById("map"),{
				center: myLatLng,
				zoom: 15
			});
			//set the marker
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				title: json.name
			});
		});
}

function submitAddLocation(){
	//obtain all the values from the form
	var addName = $("#addName").val();    
	var addLat = $("#addLat").val();    
	var addLong = $("#addLong").val();    
	var addCity = $("#addCity").val();    
	var addCountry = $("#addCountry").val();    
	var addDiff = $("#addDiff").val();    
	var addRating = $("#addRating").val();
	var fileToUpload = $("#fileToUpload").val();
	var img_url = "img-res/geo-items/temp.png";
	
	//validate all the fields that have been entered
	//very basic validation, TODO: make better
	if(!addName.trim()){
		$("#addError").text("Name field cannot be empty.");
	}else if(!addLat.trim()){
		$("#addError").text("Latitude field cannot be empty.");		
	}else if(isNaN(addLat)){
		$("#addError").text("Latitude field needs to be a number.");		
	}else if(!addLong.trim()){
		$("#addError").text("Longitude field cannot be empty.");	
	}else if(isNaN(addLong)){
		$("#addError").text("Longitude field needs to be a number.");	
	}else if(!addCity.trim()){
		$("#addError").text("City field cannot be empty.");
	}else if(!addCountry.trim()){
		$("#addError").text("Country field cannot be empty.");
	}else if(!addDiff.trim()){
		$("#addError").text("Difficulty field cannot be empty.");
	}else if(!addRating.trim()){
		$("#addError").text("Rating field cannot be empty.");
	}else if(!fileToUpload.trim()){
		$("#addError").text("Need to select a file.");
	}else{
		//validation complete, can proceed	
		//close the dialog box on success
		$('#createPopup').dialog('close');
		$.post( "php/addLocation.php", { name: addName,
			latitude: addLat,
			longatude: addLong,
			city: addCity,
			country: addCountry,
			difficulty: addDiff,
			rating: addRating,
			url : img_url})
			.done(function(data) {
				//on success: returns "id" of elementend added in database
				//on failure: returns "error" if unable to add to database
				if (data.trim() != "error"){
					
					var locId = data.trim();
					//console.log("success, add to table id:",locId);
					//create empty tr row element
					var trElement = document.createElement("tr");
					//create all the td Elements
					var td0 = document.createElement("td"); td0.appendChild(document.createTextNode(locId)); td0.setAttribute("hidden",true); 
					var td1 = document.createElement("td"); td1.appendChild(document.createTextNode(addName)); 
					var td2 = document.createElement("td"); td2.appendChild(document.createTextNode(addLat));
					var td3 = document.createElement("td"); td3.appendChild(document.createTextNode(addLong));
					var td4 = document.createElement("td"); td4.appendChild(document.createTextNode(addCity));
					var td5 = document.createElement("td"); td5.appendChild(document.createTextNode(addCountry));
					var td6 = document.createElement("td"); td6.appendChild(document.createTextNode(addDiff));
					var td7 = document.createElement("td"); td7.appendChild(document.createTextNode(addRating));
					var img = document.createElement("img"); img.setAttribute("src", img_url); img.setAttribute("alt","location image"); img.setAttribute("width","100px");
					var td8 = document.createElement("td"); td8.appendChild(img);
		    			
					var trArray = [];//array holding all the td elements
					trArray.push(td0);
					trArray.push(td1);
					trArray.push(td2);
					trArray.push(td3);
					trArray.push(td4);
					trArray.push(td5);
					trArray.push(td6);
					trArray.push(td7);
					trArray.push(td8);
					
					//append all the td elements to the tr element
					$.each(trArray, function( index, tdElement ) {
						//enable clicking for more location details on the row
						$(tdElement).click(function (){
							displayLocationDetails(locId);
						});
						//enable hovering/leaving effect for that row
						$(tdElement).hover(
							onRowHover,onRowLeave
						);
						//finally add the td element to the row
						trElement.appendChild(tdElement);
					});

					//upload the image to the server
					console.log("submitting image...");
					//var locId = 21; //temp

					//    console.log($("#fileToUpload")[0].files[0]);
					var fileData = new FormData();
					fileData.append('file', $("#fileToUpload")[0].files[0]);

					$.ajax({
						url: "php/uploadImageJson.php",
						data: fileData,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(json){
							//json request returns either json.completed = True/False depending on if the image upload was successful or not
							if (json.completed == "True"){
								//console.log("success:", json.filename);
								//must make another ajax request in order to upload the filename into the database
								$.post( "php/addImageToDB.php", { loc_id: locId, file: json.filename})
									.done(function(data) {
										//done										
										if (data.trim() =="success"){
											console.log(json.filename);
											img.setAttribute("src", json.filename);											
										}else{
											console.log(data.trim());
										}
										//console.log($("listLocations table img"));
									});
							}else{
								console.log("Error uploading the image to the server");
							}
						}
					});
					
					//add the row the table
					//console.log(trElement);
					$("#listLocations table").append(trElement);
				}else{
					console.log("error: did not add to database")
				}
			});    
	}

	return false;
}

/*
function submitImage(){
	console.log("submitting image...");
	var locId = 21; //temp

	//    console.log($("#fileToUpload")[0].files[0]);
	var fileData = new FormData();
	fileData.append('file', $("#fileToUpload")[0].files[0]);

	$.ajax({
		url: "php/uploadImageJson.php",
		data: fileData,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(json){
			//json request returns either json.completed = True/False depending on if the image upload was successful or not
			if (json.completed == "True"){
				console.log("success:", json.filename);
				//must make another ajax request in order to upload the filename into the database
				$.post( "php/addImageToDB.php", { loc_id: locId, file: json.filename})
					.done(function(data) {
						//done
						console.log(data.trim());
					});
			}else{
				console.log("Error uploading the image to the server");
			}
		}
	});

}
*/






















