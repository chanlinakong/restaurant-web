export default function menuCarousel() {

    return {

        scrollAmount: 320,

        next() {
            this.$refs.container.scrollBy({
                left: this.scrollAmount,
                behavior: 'smooth'
            });
        },


        previous() {
            this.$refs.container.scrollBy({
                left: -this.scrollAmount,
                behavior: 'smooth'
            });
        }

    }

}