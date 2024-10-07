export const formateInf = (info) => {
    if (!info) return "";
    return info.replace(/\n/g, "<br>");
};