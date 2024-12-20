function togglePopup(image = '') {
    const popup = document.getElementById('popup');
    const popupImage = document.getElementById('popup-image');
    popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    popupImage.src = image;
  }
  
  function incrementQuantity() {
    // Implement increment logic
  }
  
  function decrementQuantity() {
    // Implement decrement logic
  }
  
  function deleteFromCart() {
    // Implement delete logic
  }
  