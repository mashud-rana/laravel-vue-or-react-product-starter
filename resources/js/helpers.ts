// Helper functions for the application
import * as _ from "lodash";

// TypeScript declarations for global variables
declare global {
    interface Window {
        toast?: {
            success: (message: string) => void;
            error: (message: string) => void;
            info: (message: string) => void;
            warning: (message: string) => void;
        };
        translations?: Record<string, string>;
        locale?: string;
        csrfToken?: string;
        appUrl?: string;
    }

    const toastr: {
        options: {
            timeOut?: number;
            showDuration?: number;
            progressBar?: boolean;
            icon?: string;
            closeButton?: boolean;
            showMethod?: string;
            positionClass?: string;
        };
        success: (message: string) => void;
        error: (message: string) => void;
        info: (message: string) => void;
        warning: (message: string) => void;
    };
}

// Toastr configuration (assuming toastr is loaded globally)
if (typeof toastr !== 'undefined') {
    toastr.options = {
        timeOut: 5000,
        showDuration: 300,
        progressBar: true,
        icon: "material-icons",
        closeButton: true,
        showMethod: "fadeIn",
        positionClass: "toast-top-right",
    };
}

interface Features {
    title?: string;
    zindex?: 999;
    message?: string;
    position?: string;
}

const notifyMe = (
    message: string = "",
    type: "info" | "success" | "warning" | "error" | "question" = "info",
    position: string = "toast-top-right"
): void => {
    if (message.length > 0) {
        // Use react-hot-toast if available, fallback to toastr
        if (typeof window !== 'undefined' && window.toast) {
            window.toast[type](message);
        } else if (typeof toastr !== 'undefined') {
            toastr[type](message);
        }
    }
};

const notifyErrors = (
    messages: Object | Array<any>,
    position: string = "toast-top-right"
): void => {
    for (const errorItem in messages) {
        const items = messages[errorItem];
        if (Array.isArray(items)) {
            items.forEach((error) => {
                notifyMe(error, "error");
            });
        } else {
            notifyMe(items, "error");
        }
    }
};

const toPlainObj = (obj: any): any => {
    if (!obj || typeof obj === "undefined") {
        return obj;
    }
    return JSON.parse(JSON.stringify(obj));
};

const objToArray = (obj: {}): any[] => {
    const plainData = toPlainObj(obj);

    if (Array.isArray(plainData)) {
        return plainData;
    }

    const results = Object.keys(plainData).map((key) => {
        return plainData[key];
    });

    return results;
};

const objToArrayWithReverse = (obj: {}): any[] => {
    const array = objToArray(obj);
    return _.reverse(array);
};

const strLimit = (
    str: string,
    limitLength: number = 18,
    concatenate: string = "..."
): string => {
    let output = "";
    if (str && str.length > limitLength) {
        output = `${str.substr(0, limitLength)}${concatenate}`;
    } else {
        output = str;
    }
    return output;
};

export {
    notifyMe,
    toPlainObj,
    objToArray,
    strLimit,
    objToArrayWithReverse,
    notifyErrors
};
