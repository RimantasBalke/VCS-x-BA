let productsCheckboxes = document.querySelectorAll(".product-checked");

productsCheckboxes.forEach((checkbox)=>{
    checkbox.addEventListener('change',()=>{
        modifyQuantity(checkbox);
    });
});

function modifyQuantity(checkbox){
    let productId = checkbox.dataset.product;

    let quantityWrap = document.querySelector( `#quantity-wrap-${productId}`);

    if (checkbox.checked === true){
        quantityWrap.classList.remove('hide');
    }else{
        quantityWrap.classList.add('hide');
    }
}
