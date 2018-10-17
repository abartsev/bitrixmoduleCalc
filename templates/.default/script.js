document.addEventListener('DOMContentLoaded',function(){
    var doors = document.querySelector('.doors'),
    doorsHinge = document.querySelector('.doorsHinge'),
    quantiCell = document.querySelector('.quantiCell'), 
    box = document.querySelector('.box'),
    box2 = document.querySelector('.box2'),
    fieldDoors = document.querySelector('.fieldDoors'),
    fieldDoorsHinge = document.querySelector('.fieldDoorsHinge'),
    fieldQuantiCell = document.querySelector('.fieldQuantiCell'),
    fieldBox = document.querySelector('.fieldBox'),
    fieldBox2 = document.querySelector('.fieldBox2'),
    btn_calc = document.querySelector('.btn_calc'),
    total = document.getElementById('total'),
    message = document.querySelector('.inputtextarea'),
    limitMin = 2,
    limitMax = 10,
    limitMin2 = 1,
    limitMax2 = 100,
    objBlock = {
        div: "div",
        span: "span",
        select: "select",
        option: "option",
        input: "input",
        create: function(nameElement) {
            return document.createElement(nameElement);
        },
        addAtribute: function (element, attrElement, nameAttr) {
            element.setAttribute(attrElement, nameAttr);
            return true;
        },
        door:{
            labelWidth: "Ширина двери (см.)",
            labelHeight: "Высота двери (см.)",
            labelMaterial: "Материал двери",
            class: "liBlockDoor"
        },
        box:{
            labelWidth: "Ширина (см.)",
            labelHeight: "Высота (см.)",
            class: "liBlockBox"
        },
        compare:{
            label1: "Ширина 1 отсека(см.)",
            label2: "Кол-во полок в 1 отсеке",
            class: "liBlockCompare"
        }
    };

    btn_calc.addEventListener('click', function(e) {
        const assembly = document.querySelectorAll('#assembly');
  
        var objCre = {};
        objCre.input = {};
        objCre.span = {};
    
            for (const key in assembly) {
                if (assembly[key].nodeName == 'INPUT' && assembly[key].checked || assembly[key].value >= 1) {
                    objCre.input[assembly[key].className] = assembly[key].value;        
                }
                if (assembly[key].nodeName == 'SPAN' && assembly[key].className.split(' ')[1] == 'active') {
                    if (assembly[key].className.split(' ')[0] == 'furnitura') {
                        objCre.span[assembly[key].parentNode.className] = assembly[key].dataset.price;       
                    } else {
                        objCre.span[assembly[key].parentNode.className] = assembly[key].className.split(' ')[0];
                    }                       
                }
            }
            calculation(objCre);  
    });

    document.body.addEventListener('click', function(e){
 
        if (e.target.id == 'checkbox') {

            checkboxWork(e.target);
        }
        if (e.target.parentNode.className == 'Doors' || e.target.parentNode.className == 'Material' || e.target.parentNode.className == 'Doors_hinge' || e.target.parentNode.className == 'CompareHinge') {
            selectorWork(e.target, e.target.parentNode);
        }
    
        if( e.target.className == "furnitura" && !e.target.classList.contains('active')){
            choiceMaterial(e.target);
        }else if(e.target.classList.contains('furnitura') && e.target.classList.contains('active')){
            choiceCancelMaterial(e.target);
        }

       if(e.target.className == 'spanMin' ||  e.target.className == 'spanMax'){
            addCount(e.target);
       }
        
    });
    document.body.addEventListener('keydown', function (e) {

        if (e.target.nodeName == "INPUT" && e.target.className !== 'inputtext') {
            if (e.key >=0 || e.key <= 9 || e.key == 'Backspace') {  
            } else {
                e.preventDefault();
            }
        }
        if (e.target.className.slice(0,9) == 'doorSlide') {
            setTimeout(function(){
                let result = compare(e.srcElement.value, limitMin2, limitMax2);
                if (!result) {
                    e.srcElement.value = '';
                } 
            },0);                   
        }
    });
    doors.addEventListener('keyup', function (e) { 
  
        let result = compare(doors.value,limitMin,limitMax);
        if(result){
            doorList(doors.value);
        }else{
            doors.value = '';
            fieldDoors.innerHTML = "";
        }  
    });
    doorsHinge.addEventListener('keyup', function (e) {
        var flag = true;    

        let result = compare(doorsHinge.value,limitMin2,limitMax2);
        if(result){
            doorList(doorsHinge.value, flag);
        }else{
            doorsHinge.value = '';
            fieldDoorsHinge.innerHTML = "";
        }  
    });
    quantiCell.addEventListener('keyup', function (e) {

        let result = compare(quantiCell.value,limitMin2,limitMax2);
        if(result){
            compareList(quantiCell.value);
        }else{
            quantiCell.value = '';
            fieldQuantiCell.innerHTML = "";
        }
        
    });
    box.addEventListener('keyup', function () {

        let result = compare(box.value,limitMin2,limitMax2);
        if(result){
            boxList(box.value);
        }else{
            box.value = '';
            fieldBox.innerHTML = "";
        }
        
    });
    box2.addEventListener('keyup', function () {
   
        let flag = true;
        let result = compare(box2.value,limitMin2,limitMax2);
        if(result){
            boxList(box2.value, flag);
        }else{
            box2.value = '';
            fieldBox2.innerHTML = "";
        }
   
    });
    function compare(numb, min, max) {
        if(numb >= min && numb <= max){
            return true;
        }else{
            return false;
        }
    }
    function addCount(element) {
        var parent;
        var parentValue = 0;
        if(element.className == 'spanMax'){
            parent = element.previousElementSibling.previousElementSibling;
            parentValue = Number(element.previousElementSibling.previousElementSibling.value);

            if (element.previousElementSibling.previousElementSibling.className.slice(0,13) == 'widthboxSlide') {
                if(parentValue < 100){
                    parentValue += 20;
                    parent.value = parentValue;
                }
            } else {
                if(parentValue < 30){
                    parentValue += 5;
                    parent.value = parentValue;
                }
            }
        }else{
            parent = element.previousElementSibling;
            parentValue = element.previousElementSibling.value;
            if (element.previousElementSibling.className.slice(0,13) == 'widthboxSlide') {
                if (parentValue > 40) {
                    parentValue -= 20;
                    parent.value = parentValue;
                }
            } else {
                if (parentValue > 15) {
                    parentValue -= 5;
                    parent.value = parentValue;
                }
            }
            
        }
    }
    function checkboxWork(elem){
        if (elem.classList.contains('active')) {
            elem.classList.remove('active');
            elem.nextElementSibling.style.display = "none";
        } else {
            elem.classList.add('active');
            elem.nextElementSibling.style.display = "block";
        }
        
    };

    function selectorWork(elem, parent){
        parent = parent.children;
        for (const key in parent) {
            if (parent.hasOwnProperty(key)) {
                const element = parent[key];
                element.classList.remove('active');
            }
        }
        elem.classList.toggle('active');
        
    };
    function compareList(elemName) {
        fieldQuantiCell.innerHTML = "";
        for (let i = 0; i < elemName; i++) {
            let elemBlock = objBlock.create(objBlock.div);
            let div = objBlock.create(objBlock.div);
            let divTwo = objBlock.create(objBlock.div);
            let input = objBlock.create(objBlock.input);
            let input2 = objBlock.create(objBlock.input);
            let span = objBlock.create(objBlock.span);
            let span2 = objBlock.create(objBlock.span);

            objBlock.addAtribute(span, 'class', 'Label');
            objBlock.addAtribute(span2, 'class', 'Label');

            span.innerHTML = objBlock.compare.label1;
            span2.innerHTML = objBlock.compare.label2;

            objBlock.addAtribute(elemBlock, 'class', objBlock.compare.class);
            objBlock.addAtribute(input, 'name', 'widthcompareSlide'+i);
            objBlock.addAtribute(input, 'class', 'widthcompareSlide'+i);
            objBlock.addAtribute(input, 'id', 'assembly');

            objBlock.addAtribute(input2, 'name', 'countCompareSlide'+i);
            objBlock.addAtribute(input2, 'class', 'countCompareSlide'+i);
            objBlock.addAtribute(input2, 'id', 'assembly');

            div.appendChild(span);
            div.appendChild(input);

            divTwo.appendChild(span2);
            divTwo.appendChild(input2);

            elemBlock.appendChild(div);
            elemBlock.appendChild(divTwo);
     
            fieldQuantiCell.appendChild(elemBlock); 
        }
    }
    function doorList(elemName, flag = false) {
        
        if (flag) {
            fieldDoorsHinge.innerHTML = "";
        } else{
            fieldDoors.innerHTML = "";
        }
           for (let i = 0; i < elemName; i++) {
            let elemBlock = objBlock.create(objBlock.div);
            let div = objBlock.create(objBlock.div);
            let divTwo = objBlock.create(objBlock.div);
            let input = objBlock.create(objBlock.input);
            let span = objBlock.create(objBlock.span);
            let span2 = objBlock.create(objBlock.span);
            let select = objBlock.create(objBlock.select);

            objBlock.addAtribute(select, 'id', 'select');
            objBlock.addAtribute(select, 'class', 'Select'+i);
            objBlock.addAtribute(span, 'class', 'Label');

            span.innerHTML = objBlock.door.labelWidth;
            span2.innerHTML = objBlock.door.labelMaterial;

            objBlock.addAtribute(span2, 'class', 'Label');
            objBlock.addAtribute(elemBlock, 'class', objBlock.door.class);
            objBlock.addAtribute(input, 'name', 'doorSlide'+i);
            objBlock.addAtribute(input, 'class', 'doorSlide'+i);
            objBlock.addAtribute(input, 'id', 'assembly');

            div.appendChild(span);
            

            
            if (!flag) {
                div.appendChild(input);
                divTwo.appendChild(span2);
                divTwo.appendChild(select);
                addOptions(select);
            }
            elemBlock.appendChild(div);
            if (flag) {
                let divThree = objBlock.create(objBlock.div);
                let input4 = objBlock.create(objBlock.input);
                objBlock.addAtribute(input4, 'name', 'doorWidthSlide'+i);
                objBlock.addAtribute(input4, 'class', 'doorWidthSlide'+i);
                objBlock.addAtribute(input4, 'id', 'assembly');
                let span3 = objBlock.create(objBlock.span);
                let input3 = objBlock.create(objBlock.input);
                span3.innerHTML = objBlock.door.labelHeight;
                objBlock.addAtribute(span3, 'class', 'Label');
                objBlock.addAtribute(input3, 'name', 'doorHindeSlide'+i);
                objBlock.addAtribute(input3, 'class', 'doorHindeSlide'+i);
                objBlock.addAtribute(input3, 'id', 'assembly');
                div.appendChild(input4);
                divThree.appendChild(span3);
                divThree.appendChild(input3);
                elemBlock.appendChild(divThree);

            }
            elemBlock.appendChild(divTwo);
            if (flag) {
                fieldDoorsHinge.appendChild(elemBlock); 
            } else {
                fieldDoors.appendChild(elemBlock); 
            }    
           }
      
    }
    function boxList(countBox, flag = false){
        var name = 'Slide';
        if (flag) {
            fieldBox2.innerHTML = "";
            name = 'Slide2';
        }else{
            fieldBox.innerHTML = "";
        }
        
        for (let i = 0; i < countBox; i++) {
            let elemBlock = objBlock.create(objBlock.div);
            let div = objBlock.create(objBlock.div);
            let divTwo = objBlock.create(objBlock.div);
            let input = objBlock.create(objBlock.input);
            let input2 = objBlock.create(objBlock.input);
            let span = objBlock.create(objBlock.span);
            let span2 = objBlock.create(objBlock.span);
            let spanMin = objBlock.create(objBlock.span);
            let spanMax = objBlock.create(objBlock.span);
            let span2Min = objBlock.create(objBlock.span);
            let span2Max = objBlock.create(objBlock.span);

            objBlock.addAtribute(spanMin, 'class', 'spanMin');
            objBlock.addAtribute(spanMax, 'class', 'spanMax');
            objBlock.addAtribute(span2Min, 'class', 'spanMin');
            objBlock.addAtribute(span2Max, 'class', 'spanMax');

            objBlock.addAtribute(span, 'class', 'Label');
            objBlock.addAtribute(span2, 'class', 'Label');

            span.innerHTML = objBlock.box.labelWidth;
            span2.innerHTML = objBlock.box.labelHeight;

            objBlock.addAtribute(elemBlock, 'class', objBlock.box.class);
            objBlock.addAtribute(input, 'name', 'widthbox'+name+i);
            objBlock.addAtribute(input, 'class', 'widthbox'+name+i);
            objBlock.addAtribute(input, 'id', 'assembly');
            input.value = 40;

            objBlock.addAtribute(input2, 'name', 'heightboxSlide'+name+i);
            objBlock.addAtribute(input2, 'class', 'heightboxSlide'+name+i);
            objBlock.addAtribute(input2, 'id', 'assembly');
            input2.value = 15;

            div.appendChild(span);
            div.appendChild(input);
            div.appendChild(spanMin);
            div.appendChild(spanMax);

            divTwo.appendChild(span2);
            divTwo.appendChild(input2);
            divTwo.appendChild(span2Min);
            divTwo.appendChild(span2Max);

            elemBlock.appendChild(div);
            elemBlock.appendChild(divTwo);
            if(flag){
                fieldBox2.appendChild(elemBlock); 
            } else {
                fieldBox.appendChild(elemBlock); 
            }
              
        }
    }
    function addOptions(elemName) {
        let count = 0;
        for (const key in material.Standart) {
            if (material.Standart.hasOwnProperty(key)) {
                const option = objBlock.create(objBlock.option);
                const element = material.Standart[key];
                option.innerHTML = element.MATERIAL_NAME;
                option.setAttribute('id', count++);
                option.setAttribute('class', 'elementDoor');
                elemName.appendChild(option);
            }
                
        }
    }
    function choiceMaterial(elem){

            elem.classList.toggle('active');
    }
    function choiceCancelMaterial(elem){
        elem.classList.toggle('active');
    }
    function calculation(obj) {
        var price = 0,
        priceDoor = 0, 
        doorsHinge = 0,
        cell = 0,
        options = 0,
        w = 0,
        c = 0, 
        arPrice = material.Price;

            if (obj.span.Material) {
                var materialPrice = Number(arPrice[obj.span.Material.toLowerCase()]);
            } else {
                var materialPrice = Number(arPrice['Standart']);
            }
            
            let ceiling = obj.input.ceiling_two ? 2 : 1
            if (obj.input.ceiling_two || obj.input.ceiling_one) {
                c = ((obj.input.cab_width/100) * (obj.input.cab_height/100) * materialPrice) * ceiling;
                
            }
            if(obj.input.wall){
                w = ((obj.input.cab_width/100) * (obj.input.cab_depth/100)) * materialPrice;
            } 
            if(w > 0 || c > 0) {
                price = w + c;
            }

 
            if(obj.input.doors){
                let materialPrice = material[obj.span.Doors];
                
                for (let i = 0; i < obj.input.doors; i++) {
                    const element = document.querySelector('.doorSlide'+i).value;
                    const select = document.querySelector('.Select'+i);
                    let option;
                    for (const iterator of select.options) {
                        if(iterator.selected) {
                            option = iterator.id;                           
                            priceDoor += compare(materialPrice, option, element); 
                            
                                             
                        }                
                    }                                    
                }
                function compare(arObj, id, count){
                    if (count <= 50) {
                        count = 'WIDTH_50';
                    }else {
                        count = 'WIDTH_' + Math.ceil(count/10)*10;
                    }
            
                    return Number(arObj[id][count]);
                   
                }
            }
            if (obj.input.doorsHinge) {
                
                let materialPrice = Number(arPrice[obj.span.Doors_hinge.toLowerCase()]);
                
                for (let i = 0; i < obj.input.doorsHinge; i++) {
                    const elementWidth = document.querySelector('.doorWidthSlide'+i).value;
                    const elementHinde = document.querySelector('.doorHindeSlide'+i).value;
                    doorsHinge += ((elementWidth/100)*(elementHinde/100)*materialPrice)+800;              
                }
            }
 
            if (obj.input.quantiCell) {
                let materialPrice = Number(arPrice[obj.span.CompareHinge.toLowerCase()]);
                for (let i = 0; i < obj.input.quantiCell; i++) {
                    const elementWidth = document.querySelector('.widthcompareSlide'+i).value;
                    const elementCount = document.querySelector('.countCompareSlide'+i).value;
                    cell += ((elementWidth/100)*(obj.input.cab_depth/100)*materialPrice)*elementCount || 1;              
                }

            }
            if (obj.input.box) {
              
                for (let i = 0; i < obj.input.box; i++) {
                    const elementWidth = document.querySelector('.widthboxSlide'+i).value;
                    const elementHight = document.querySelector('.heightboxSlideSlide'+i).value;                    
                    cell += Number(material.Nabor.box[elementWidth][elementHight]);              
                }

            }
            if (obj.input.box2) {
                for (let i = 0; i < obj.input.box2; i++) {
                    const elementWidth = document.querySelector('.widthboxSlide2'+i).value;
                    const elementHight = document.querySelector('.heightboxSlideSlide2'+i).value;
                    cell += Number(material.Nabor.box[elementWidth][elementHight]);               
                }
                
            }
            if (obj.input.basket1) {
                cell += obj.input.basket1 * 1700;

            }
            if (obj.input.basket2) {
                cell += obj.input.basket2 * 1900;

            }
            if(obj.input.hanging){
                cell += 440;

            }

            for (const key in obj.span) {
                if (key.slice(0,10) == 'optionElem') {
                    options += Number(obj.span[key]);
                    
                }
            }
    
            total.innerHTML = (price + priceDoor + doorsHinge + cell + options).toFixed() + " ₽";

            message.value = `Стоимость:${(price + priceDoor + doorsHinge + cell + options).toFixed()}\nМатериал:${obj.span.Material}, Ширина: ${obj.input.cab_width || 0}, Глубина: ${obj.input.cab_depth || 0}, Высота: ${obj.input.cab_height || 0} \nБоковые стены: ${ceiling || 0}, Потолок: ${obj.input.wall || 0}\nРаз-Двери кл-во ${obj.input.doors || 0}, материал ${obj.span.Doors}\nДвери на петлях кл-во ${obj.input.doorsHinge || 0}, материал ${obj.span.Doors_hinge}\nМатериал отсека: ${obj.span.CompareHinge || 0}, кол-во: ${obj.input.quantiCell || 0}\nЯщики п выдвижения: ${obj.input.box || 0}, Ящики с доводчиками: ${obj.input.box2 || 0}\nСотовые корзины глубина 160 см: ${obj.input.basket1 || 0}, Сотовые корзины глубина 320 см: ${obj.input.basket2 || 0}\nВешало: ${obj.input.hanging || 0}\nДополнительные опции:${options || 0}`;

    }
    
});


