function update() {
    $.ajax({
        url: "updateLastActivity",
        type: "POST"
    });
};

update();
setInterval(update, 1000 * 60 * 10);