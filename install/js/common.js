
document.addEventListener('click', function(e){
    if (e.target.className == "change") {
        //e.preventDefault();
        var id = e.target.id;
        e.target.innerHTML = "отмена";
        e.target.setAttribute('class', 'close');
        var arChange = document.querySelectorAll('.change');
        for (const key in arChange) {
            if (arChange.hasOwnProperty(key)) {
                arChange[key].setAttribute('class', 'stacChange');
            }
        }
        
         
        var arResult = e.target.parentNode.parentNode;
        var parentId = arResult.id;

        var arChild = arResult.children;
        var inputHide = this.createElement('INPUT');
        var inputHide2 = this.createElement('INPUT');

        for (const key in arChild) {
            if (arChild.hasOwnProperty(key)) {
                if(arChild[key].id != "edit"){
                var input = this.createElement('INPUT');
                var value = arChild[key].innerHTML;
                arChild[key].innerHTML = '';
                arChild[key].appendChild(input);
                input.setAttribute('name', arChild[key].id);
                input.setAttribute('type', 'text');
                input.value  = value;
                }
                
            }
        }
        arResult.appendChild(inputHide);
        inputHide.setAttribute('type', 'hidden');
        inputHide.setAttribute('name', 'id');
        inputHide.value = id;

        arResult.appendChild(inputHide2);
        inputHide2.setAttribute('type', 'hidden');
        inputHide2.setAttribute('name', 'tableName');
        inputHide2.value = parentId;
        
    } else if(e.target.className == "close") {
        e.target.innerHTML = "Изменить";
        e.target.setAttribute('class', 'change');
        var arChange = document.querySelectorAll('.stacChange');
        for (const key in arChange) {
            if (arChange.hasOwnProperty(key)) {
                arChange[key].setAttribute('class', 'change');
            }
        }
        var arResult = e.target.parentNode.parentNode;
        var arChild = arResult.children;

        for (const key in arChild) {
            if (arChild.hasOwnProperty(key)) {
                if(arChild[key].id != "edit"){
                if (arChild[key].firstChild) {
                    var value = arChild[key].firstChild.value;
                }   
                arChild[key].innerHTML = '';
                arChild[key].innerHTML = value;
                }
                
            }
        }
    }
});
