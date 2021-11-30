import request from "@/utils/request";

export function sqlQueryRequest(sql) {
    return request({
        method: 'get',
        params: {
            type: 1,
            sql: sql
        }
    })
}

export function sqlmodifyRequest(sql) {
    return request({
        method: 'get',
        params: {
            type: 2,
            sql: sql
        }
    })
}
