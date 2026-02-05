document.querySelector('#search').oninput = function() {
    let val = this.value.trim();
    let searchItems = document.querySelectorAll('.search');
    if (val != '') {
        searchItems.forEach(function(elem) {
            if (elem.innerText.search(val) == -1) {
                elem.classList.add('elem__hide');
                //elem.innerHTML = elem.innerText;
            }
            else {
                elem.classList.remove('elem__hide');
                //let str = elem.innerText;
                //elem.innerHTML = insertMark(str, elem.innerText.search(val), val.length);
            }
        });
    }
    else {
        searchItems.forEach(function(elem) {
            elem.classList.remove('elem__hide');
            //elem.innerHTML = elem.innerText;
        });
    }
}

//function insertMark(string, pos, len) {
//    return string.slice(0, pos) + '<span>' + string.slice(pos, pos + len) + '</span>' + string.slice(pos + len);
//}