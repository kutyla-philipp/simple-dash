FROM golang:alpine as builder

WORKDIR /go/src/github.com/willfantom/simple-dash
COPY ./. .
RUN CGO_ENABLED=0 GOOS=linux go build -a -installsuffix cgo -o main .

FROM scratch

ENV CONFIG_DIR /config

WORKDIR /app
COPY --from=builder /go/src/github.com/willfantom/simple-dash/templates templates
COPY --from=builder /go/src/github.com/willfantom/simple-dash/main main

CMD ["./main"]