export const formateDate = (dateString) => {
    const date = new Date(dateString);
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
    };
    return date.toLocaleDateString("ru-RU", options);
};