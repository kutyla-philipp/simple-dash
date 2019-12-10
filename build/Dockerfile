FROM golang:alpine as builder

WORKDIR /go/src/github.com/willfantom/simple-dash
COPY ./. .
RUN CGO_ENABLED=0 go build -a -o main .

FROM scratch

ENV CONFIG_DIR /config

WORKDIR /app
COPY --from=builder /go/src/github.com/willfantom/simple-dash/templates templates
COPY --from=builder /go/src/github.com/willfantom/simple-dash/main main

CMD ["./main"]