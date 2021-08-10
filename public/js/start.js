let fridgeContainer = document.getElementById("fridge-container");
let cabinetContainer = document.getElementById("cabinet-container");

let fridge = {
    parent:fridgeContainer,
    name:'fridge',
    status:'closed',
    modal:'#fridge-products'
};
let cabinet = {
    parent:cabinetContainer,
    name:'cabinet',
    status:'closed',
    modal:'#cabinet-products'
};

const statuses = {
    open:'open',
    closed:'closed',
};

const containers = [fridge,cabinet];

function init(){
    fridgeContainer.addEventListener('click',()=>{
        modifyContainer(fridge);
    });

    cabinetContainer.addEventListener('click',()=>{
        modifyContainer(cabinet);
    });

    $('#fridge-products-modal').on('hide.bs.modal', function(){
        containers.forEach((c)=>{
            if (c.status === statuses.open){
                modifyContainer(c);
            }
        });
    })
}

function modifyContainer(container){
    let img = container.parent.querySelector('img');
    let oldImgSrc = img.src;

    if (container.status === 'closed'){
        container.status = statuses.open;

        img.src = oldImgSrc.replace(
            `${container.name}_${statuses.closed}`,
            `${container.name}_${statuses.open}`
        );
    }else{
        container.status = statuses.closed;

        img.src = oldImgSrc.replace(
            `${container.name}_${statuses.open}`,
            `${container.name}_${statuses.closed}`
        );
    }

    showProducts(container.status, container);
}

function showProducts(state, container){
    let modal = document.querySelector(container.modal);
    let typeInput = document.querySelector(`#type-${container.name}`);

    if (state === statuses.open) {
        $(`#fridge-products-modal`).modal('show');
        modal.classList.remove('hide');
        typeInput.disabled = false;
    }else{
        modal.classList.add('hide');
        typeInput.disabled = true;
    }
}

init();
