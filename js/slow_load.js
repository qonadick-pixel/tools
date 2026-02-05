function onEntry(entry) {
    entry.forEach(change => {
        if (change.isIntersecting) {
            change.target.classList.add('elem__show');
        } else {
            change.target.classList.remove('elem__show');
        }
    });
}

let options = {
    threshold: [0.5]
};
let observer = new IntersectionObserver(onEntry, options);
let elements = document.querySelectorAll('.elem__anim');
for (let elm of elements) {
    observer.observe(elm);
}