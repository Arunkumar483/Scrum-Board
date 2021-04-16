const drag = (event) => {
    console.log(event);
    event.dataTransfer.setData("text/plain", event.target.id);
}

const allowDrop = (ev) => {
    ev.preventDefault();
    if (hasClass(ev.target, "dropzone")) {
        addClass(ev.target, "droppable");
    }
}
0

const clearDrop = (ev) => {
    removeClass(ev.target, "droppable");
}

const drop = (event) => {
    event.preventDefault();
    const data = event.dataTransfer.getData("text/plain");
    console.log(data)
    const element = document.querySelector(`#${data}`);
    console.log(element)
    try {
        // remove the spacer content from dropzone
        event.target.removeChild(event.target.firstChild);
        // add the draggable content
        event.target.appendChild(element);
        // remove the dropzone parent
        unwrap(event.target);
    } catch (error) {
        console.warn("can't move the item to the same place")
    }
    $.ajax({
        type: 'POST',
        url: 'indexupdate.php',
        data: { data: data },
        success: function() {
            console.log(data)
            alert('Updated');
        }
    });
    updateDropzones();

}

const updateDropzones = () => {
    /* after dropping, refresh the drop target areas
      so there is a dropzone after each item
      using jQuery here for simplicity */

    console.log("update drop zones")

    var dz = $('<div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>');

    // delete old dropzones
    $('.dropzone').remove();

    // insert new dropdzone after each item   
    dz.insertAfter('.card.draggable');

    // insert new dropzone in any empty swimlanes
    $(".items:not(:has(.card.draggable))").append(dz);

};

// helpers
function hasClass(target, className) {
    return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
}

function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
}

function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        ele.className = ele.className.replace(reg, ' ');
    }
}

function unwrap(node) {
    node.replaceWith(...node.childNodes);
}