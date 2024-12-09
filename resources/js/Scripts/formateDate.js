export const formateDate = (dateString) => {
    const date = new Date(dateString);

    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };

    const formattedDate = new Intl.DateTimeFormat("ru-RU", options).format(
        date
    );

    return formattedDate;
};

export const formateTime = (timeString) => {
    const [hours, minutes] = timeString.split(":");

    const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    const date = new Date();
    date.setUTCHours(parseInt(hours, 10))
    date.setUTCMinutes(parseInt(minutes, 10));

    const options = {
        hour: "2-digit",
        minute: "2-digit",
        timeZone: userTimeZone,
        hour12: false,
    };

    const formattedTime = date.toLocaleString('ru-RU', options);

    return formattedTime;
};
