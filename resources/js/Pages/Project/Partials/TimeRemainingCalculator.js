export const calculateRemainingTime = (dueTime) => {
    return calcuateInterval(Date.parse(dueTime) - currentTime);
}

export const isOverdue = (dueTime) => {
    return Date.parse(dueTime) < currentTime;
}

// amount of miliseconds
const intervals = {
    hour: 3600000,
    day: 86400000,
    week: 604800000,
    month: 18144000000
}

const currentTime = Date.now();


// check if it should be displayed in month, week, day or hours
const calcuateInterval = (timeDifference) => {
    if (timeDifference >= intervals.month || timeDifference <= -intervals.month) {
        let months = Math.floor(timeDifference / intervals.month)
        return (months > 1 || months < -1) ? `${months} maanden` : `${months} maand`;
    } else if (timeDifference >= intervals.week || timeDifference <= -intervals.week) {
        let weeks = Math.floor(timeDifference / intervals.week)
        return (weeks > 1 || weeks < -1) ? `${weeks} weeken` : `${weeks} week`;
    } else if (timeDifference >= intervals.day || timeDifference <= -intervals.day) {
        let days = Math.floor(timeDifference / intervals.day)
        let hours = Math.floor((timeDifference - intervals.day * days) / intervals.hour)
        return (days > 1 || days < -1) ? `${days} dagen ${hours} uur` : `${days} dag ${hours} uur`;
    } else if (timeDifference >= intervals.hour || timeDifference <= intervals.hour) {
        let hours = Math.floor(timeDifference / intervals.hour)
        return `${hours} uur`;
    }
}