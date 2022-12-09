

/*
 * Assuming that id #lat and #long exists. 
 * This function assigns lat and long into DOM which have id #lat and #long
 * 
 * @returns nothing
 */
function setGeoLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setPosition);
    } else { 
    	alert("Unable to find location");
    }
}

function setPosition(position) {
    document.getElementById('lat').value=position.coords.latitude;
    document.getElementById('long').value=position.coords.longitude;
}

function smsCredit(count) {
    var quotient = Math.floor(count / 160);
    var rem = count % 160;
    return (rem == 0) ? quotient : (quotient + 1);
}
