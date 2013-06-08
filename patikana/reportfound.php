<script type="text/javascript">
	jQuery(document).ready(function() {
		$('#moreinfo').hide();
		$("#itemtypesave").change(function(e) {
			// var itemtype = $("#itemtypesave").is(":selected");
			//$("#hiddentype").attr("value", itemtype);
			if($("#default").is(":selected")) {
				$('#moreinfo').hide();
			}
			if($("#nationalID").is(":selected")) {
					$('#moreinfo').hide();
				$('#itemtypetext').text("ID Number");
			}
			if($("#other").is(":selected")) {
				//Show some other
				$('#moreinfo').show();
				$('#itemtypetext').text("Name for this other");
				$('#itemtypetext').text("Item's Number");
			}

			if($("#schoolID").is(":selected")) {
				//Show some other
				$('#moreinfo').show();
				$('#otheridentifier').text("School/Collage/Campus");
				$('#itemtypetext').text("Registration Number");
			}
			if($("#atm").is(":selected")) {
				//Show some other
				$('#moreinfo').show();
				$('#otheridentifier').text("Bank");
				$('#itemtypetext').text("A/C Number");
			}

			if($("#passport").is(":selected")) {//Show some other
				$('#moreinfo').show();
				$('#otheridentifier').text("Country");
				$('#itemtypetext').text("Passport Number");
			}
			if($("#dl").is(":selected")) {
				//Hide the other row
				$('#moreinfo').hide();
				$('#itemtypetext').text("Driving Licence Number");
			}

		});
	});

</script>
<div id="announceDialog">
	<span id="dialogtitle">Report Document Found</span>
	</br> <div id="notification"></div>
	</br>
	<form id="found_doc_form">
		<table id="reportfoundtable">
			<tr>
				<td>&nbsp;</td><td>Item</td><td>
				<select id="itemtypesave" name="itemtypesave">
					<option id="default">Click here to select:</option>
					<option id="nationalID">National ID</option>
					<option id="schoolID">School ID</option>
					<option id="atm">ATM card</option>
					<option id="dl">Driving licence</option>
					<option id="passport">Passport</option>
					<option id="other">Some other</option>
				</select></td>
			</tr>
			<tr id="moreinfo">
				<td>&nbsp;</td><td id="otheridentifier"></td><td>
				<input type="text" name="someothersave" id="someothersave" size="25%"/>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>Owner\'s Names</td><td>
				<input type="text" name="names" id="names" size="25%"/>
				</td>
			</tr>
			<tr>
				<td></td><td id="itemtypetext">Item\'s Number</td><td>
				<input type="text" name="itemnumber" id="itemnumber" size="25%"/>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td><td>Where You Found It</td><td>
				<input type="text" name="locationfound" id="locationfound" size="25%"/>
				</td>
			</tr>
		</table>
	</form>
	<div id="help"></div>
</div>