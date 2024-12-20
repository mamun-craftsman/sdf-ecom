

var toggleOpen = document.getElementById('toggleOpen');
var toggleClose = document.getElementById('toggleClose');
var collapseMenu = document.getElementById('collapseMenu');

function handleClick() {
  if (collapseMenu.style.display === 'block') {
    collapseMenu.style.display = 'none';
  } else {
    collapseMenu.style.display = 'block';
  }
}

toggleOpen.addEventListener('click', handleClick);
toggleClose.addEventListener('click', handleClick);



document.addEventListener("DOMContentLoaded", function () {
  // Get all checkbox inputs
  const checkboxes = document.querySelectorAll("input[type='checkbox']");

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener("change", function () {
      if (this.checked) {
        // Collapse all other checkboxes except the clicked one
        checkboxes.forEach(cb => {
          if (cb !== this) {
            cb.checked = false;
          }
        });
      }
    });
  });
});












var menu = [];
jQuery('.swiper-slide').each(function (index) {
  menu.push(jQuery(this).find('.slide-inner').attr("data-text"));
});
var interleaveOffset = 0.5;
var swiperOptions = {
  loop: true,
  speed: 1000,
  parallax: true,
  autoplay: {
    delay: 6500,
    disableOnInteraction: false,
  },
  watchSlidesProgress: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  on: {
    progress: function () {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        var slideProgress = swiper.slides[i].progress;
        var innerOffset = swiper.width * interleaveOffset;
        var innerTranslate = slideProgress * innerOffset;
        swiper.slides[i].querySelector(".slide-inner").style.transform =
          "translate3d(" + innerTranslate + "px, 0, 0)";
      }
    },

    touchStart: function () {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = "";
      }
    },

    setTransition: function (speed) {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = speed + "ms";
        swiper.slides[i].querySelector(".slide-inner").style.transition =
          speed + "ms";
      }
    }
  }
};

var swiper = new Swiper(".swiper-container", swiperOptions);

// DATA BACKGROUND IMAGE
var sliderBgSetting = $(".slide-bg-image");
sliderBgSetting.each(function (indx) {
  if ($(this).attr("data-background")) {
    $(this).css("background-image", "url(" + $(this).data("background") + ")");
  }
});



// Modal Trigger
// $(document).ready(function () {
//     // Show modal on card click and prevent background scrolling
//     $(".product-card").on("click", function () {
//       const modalId = $(this).data("target"); // Get the target modal ID
//       const modal = $(modalId); // Select the modal based on the ID

//       // Show the modal with fade-in effect
//       modal.removeClass("hidden").addClass("show"); // Add 'show' class to trigger visibility and opacity
//       $("body").addClass("modal-open"); // Disable background scrolling
//     });

//     // Hide modal on close button click or clicking outside the modal
//     $(document).on("click", function (e) {
//       if ($(e.target).is("#closeModal") || $(e.target).is(".modal-container")) {
//         const modal = $(".modal-container.show"); // Get the currently open modal

//         // Hide the modal with fade-out effect
//         modal.removeClass("show").addClass("hidden"); // Remove 'show' to trigger fade-out and hide modal
//         $("body").removeClass("modal-open"); // Enable background scrolling
//       }
//     });

//     // Prevent modal from closing when clicking inside modal content
//     $(".modal-content").on("click", function (e) {
//       e.stopPropagation(); // Stop the event from propagating to the parent elements
//     });
//   });








// Slider Section




// Array of products
const profiles = [];

// Fetch product data from backend
fetch('/api/products')  // Use the correct URL where your API is exposed
  .then(response => response.json())  // Parse the JSON response
  .then(data => {
    
    // Push the filtered data to profiles
    profiles.push(...data);
    renderProfiles(profiles);
  })
  .catch(error => {
    console.error('Error fetching products:', error);
  });



let cart = JSON.parse(localStorage.getItem('cart')) || [];  // Load cart from localStorage on page load

function updateCartCount() {
  document.getElementById('cardCount').innerHTML = cart.length;
  if (cart.length > 0) {
    localStorage.setItem('cart',JSON.stringify(cart))
  }
}
updateCartCount();

// Render products
function renderProfiles() {
  const container = document.querySelector('#gtid-present');
  const filteredData = profiles.filter(profile => profile.show_feat === 1);
  
  filteredData.forEach(profile => {
    const card = `
 <div
              class="bg-white rounded-xl overflow-hidden shadow-w cursor-pointer relative  mx-auto product-card w-[185px] md:w-[250px]"
              data-target="#productModal2"
              data-title="{$profile.title}"
              data-price="{$profile.price}"
              data-image="{$profile.imageUrl}"
              data-description="{$profile.description}"
            >
              <div class="relative-full border-b-8 border-b-[#222E78]">
                <img
                onclick="showModal(${profile.id})"
                  src=${profile.imageUrl}
                  alt="Product 2"
                  class="h-[152px] md:h-[280px] w-[185px] md:w-full object-contain"
                />
                <div class="absolute top-[138px] md:top-[260px] sm:bottom-[92px] left-[28px] md:left-[60px]">
                    <button
                    onclick="addToCartAndRedirect(${profile.id})"
                  class="group relative h-8 md:h-10 w-[130px] rounded-full bg-[#1B266B] px-5 text-white text-sm sm:text-md"
                >
                  <span class="relative inline-flex overflow-hidden">
                    <div
                      class="translate-y-0 skew-y-0 transition duration-500 group-hover:-translate-y-[120%] group-hover:skew-y-12"
                    >
                      অর্ডার করুন
                    </div>
                    <div
                      class="absolute translate-y-[115%] skew-y-12 transition duration-500 group-hover:translate-y-0 group-hover:skew-y-0"
                    >
                     অর্ডার করুন
                    </div>
                  </span>
                </button>
                </div>
              </div>
              <!-- Price Tag -->
              <div
                class="absolute top-[3px] right-[3px] bg-green-500 text-white text-lg font-bold px-4 md:px-6 py-1 rounded-lg shadow-lg clip-leftpoint"
              >
                <span class="text-sm md:text-md"
                  ><i class="fa-solid fa-bangladeshi-taka-sign pr-1 "></i
                  >${profile.price}</span>

              </div>
              <div class="p-4">
              <a href="../product/${profile.id}"><h3
                  class="text-[12px]   sm:text:base md:text-md lg:text-[16px] font-bold text-[#2D2A32] hover:text-[#33C659] transition duration-300"
                >
                 ${profile.title} 
                </h3></a>
                
                <div class="mt-2 flex items-center flex-wrap gap-2">
                  <div
                    class="mx-auto bg-gradient-to-r from-sky-500 to-indigo-500 rounded-full shadow-lg shadow-purple-200 flex items-center justify-center text-lg sm:text-xl px-4 py-1 md:py-2 cursor-pointer hover:outline-none active:outline-none whitespace-nowrap select-none touch-manipulation min-w-[100px] sm:min-w-[125px]  hover:-translate-y-1 transition duration-100"
                  >
                    <i class="fa-solid fa-bag-shopping text-white mr-1 text-sm md:text-base"></i>
                    <span
                    id="addToCardId" onclick="addToCart(${profile.id})"
                    class="text-white text-sm md:text-base">ব্যাগে রাখুন</span>
                  </div>
                </div>
              </div>
            </div>
`;
    container.innerHTML += card;
  });
}

// Add product to cart
function addToCart(productId) {

  const product = profiles.find(p => p.id === productId);
  const existingProduct = cart.find(p => p.id === productId);
  if (existingProduct) {
    existingProduct.quantity++;
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  renderCart();
  openSlider();
  updateCartCount();
  localStorage.setItem('cart',JSON.stringify(cart))
}

// buy now button
const addToCartAndRedirect = (productId) => {
  const product = profiles.find(p => p.id === productId);
  const existingProduct = cart.find(p => p.id === productId);

  if (existingProduct) {
    existingProduct.quantity++;
  } else {
    cart.push({ ...product, quantity: 1 });
  }

  renderCart();
  openSlider();
  updateCartCount();
  localStorage.setItem('cart', JSON.stringify(cart));

  // Redirect to another page
  window.location.href = '/order-now'; // Replace '/another-page' with your target URL
};


// Render cart
function renderCart() {

  const cartContainer = document.getElementById('cart-items');
  cartContainer.innerHTML = ''; // Clear previous cart items

  if (cart.length === 0) {
    // Show message if cart is empty
    cartContainer.innerHTML = `<p class="text-center p-4"> আপনার ব্যাগ খালি!</p>`;
  } else {
    cart.forEach(item => {
      const cartItem = `
        <div class="flex justify-between items-center border-b p-4">
          <div class="flex flex-col text-sm">
            <h3 class="text-lg">${item.title}</h3>
            <p><span class="font-bold pr-1">মূল্যঃ</span> ${item.price} টাকা</p>
            <p class="flex gap-2 items-center" id="quantity"><span class="font-bold pr-1">পরিমাণঃ</span>
              <span style="border: 1px solid green; border-radius:20px;" class=" w-[60px] flex items-center justify-evenly">
                <button id="decrease-${item.id}" class="text-sm text-red-600 font-extrabold" onclick="updateQuantity(${item.id}, 'decrease')"> &#8722;</button> 
                <span class="flex">${item.quantity} </span>
                <button id="increase-${item.id}" class="text-sm text-green-600 font-extrabold" onclick="updateQuantity(${item.id}, 'increase')">+</button>
              </span>
            </p>
          </div>
          <div class="flex items-center gap-4">
            <img src="${item.imageUrl}" alt="${item.title}" class="w-16 h-16 object-contain rounded">
            <button id="delete-${item.id}" onclick="deleteFromCart(${item.id})" class="text-xl text-red-600">
              <i id="delete-icon" class="fas fa-trash"></i> <!-- Delete Icon -->
            </button>
          </div>
        </div>
      `;
      cartContainer.innerHTML += cartItem;
    });
  }
}




// Delete item from cart
function deleteFromCart(productId) {
  cart = cart.filter(p => p.id !== productId); // Remove the product from cart
  renderCart(); // Re-render the cart after deleting the item
  localStorage.setItem('cart',JSON.stringify(cart))
  updateCartCount();
}

// Update quantity in cart
function updateQuantity(productId, action) {
  const productIndex = cart.findIndex(p => p.id === productId);
  if (action === 'increase') {
    cart[productIndex].quantity++;
  } else if (action === 'decrease') {
    cart[productIndex].quantity--;
    // If quantity is zero, remove the product from cart
    if (cart[productIndex].quantity === 0) {
      cart = cart.filter(p => p.id !== productId); // Remove product from cart
    }
  }
  localStorage.setItem('cart',JSON.stringify(cart))
  renderCart(); // Re-render the cart after updating quantity
  updateCartCount();
}

// Initialize profile rendering
renderProfiles();
renderCart();


// Show modal with profile data
function showModal(id) {
  const profile = profiles.find(p => p.id === id);
  if (profile) {
    document.getElementById('modalImage').src = profile.imageUrl;
    document.getElementById('modalTitle').textContent = profile.title;
    document.getElementById('modalDescription').innerHTML = profile.description ;
    document.getElementById('modalPrice').textContent = profile.price;
    document.getElementById('productModal').classList.remove('hidden');
  
    // Dynamically set the onclick event for the Buy Now button
    const buyNowButton = document.getElementById('buyNowButton');
    document.getElementById('detailsButton').href = "/product/" + profile.id;
    buyNowButton.onclick = () => addToCartAndRedirect(id);

    document.getElementById('productModal').classList.remove('hidden');
  
  
  }
}

// Hide modal
document.getElementById('closeModal').addEventListener('click', () => {
  document.getElementById('productModal').classList.add('hidden');
});

// Hide modal when clicking outside
document.getElementById('productModal').addEventListener('click', (e) => {
  if (e.target === document.getElementById('productModal')) {
    document.getElementById('productModal').classList.add('hidden');
  }
});












