export const priceFormatted = (price) => new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    currencyDisplay: "code"
}).format(price);