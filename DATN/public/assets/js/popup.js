document.getElementById('cancelButton').onclick = function() {
    document.getElementById('confirmPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
    };

    document.getElementById('noButton').onclick = function() {
    document.getElementById('confirmPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
    };

    document.getElementById('yesButton').onclick = function() {
        console.log("Hủy bỏ đã được xác nhận.");
        document.getElementById('confirmPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    };