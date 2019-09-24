import React from 'react';

class ListsAds extends React.Component {
    constructor(props) {
        super();
        this.state = {
            currentPage: 1,
            itemPerPage: 20,
            totalPage :1,
        };
        this.state.totalPage = Math.ceil(props.result.length / this.state.itemPerPage);
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidUpdate(prevProps) {
        let newProps = this.props.result.length;
        let oldProps = prevProps.result.length;
        // reset page if items array has changed
        if (newProps !== oldProps) {
            this.state.totalPage = Math.ceil(newProps / this.state.itemPerPage);
            this.setState({
                currentPage: Number(1)
            });
        }
    }

    handleClick(event) {
        if(event.target.id < 1 || event.target.id >this.state.totalPage || this.state.totalPage ===1){
            return;
        }
       this.setState({
            currentPage: Number(event.target.id)
        });
    }

    renderResult(items){

        return items.map((result) => {

            const id = result.id;
            const generalCategory = result.generalCategory;
            const category = result.category;
            const imageOne = result.imageOne;
            const imageTow = result.imageTow;
            const imageThree = result.imageThree;
            const price = result.price;
            const pPrice = result.pPrice;
            const city = result.city;
            const ville = result.ville;
            const dateOfAd = result.dateOfAd;
            const typeOfAd = result.typeOfAd;

            let offerImage;
            if (imageOne !== null) {
                offerImage = imageOne;
            } else {
                if (imageTow !== null) {
                    offerImage = imageTow;
                } else {
                    if (imageThree !== null) {
                        offerImage = imageThree
                    } else {
                        offerImage = "../../assets/images/icons/sansphoto.jpeg";
                    }
                }
            }
            let demandImage = "../../assets/images/icons/search.jpg";
            let image;
            if (typeOfAd === 'Offer') {
                image = offerImage;
            } else {
                image = demandImage;
            }
            let oldPrice;
            let newPrice;
            if (pPrice !== null) {
                oldPrice = <span className="title-blue float-left"><del>{pPrice}€</del></span>;
            }
            if (pPrice !== null) {
                newPrice = <span className="title-rose float-left">{price}€</span>;
            }
            let place;
            if (city === null) {
                place = ville;
            } else {
                place = city;
            }
            let url = Routing.generate('ad_show', {'id': id});

            return (

                <div className="text-center col-md-3 px-md-2 my-2 ad_show" key={Math.random()}>
                    <div id="ad_index" className="ad_index">
                        <a href={url}>
                            <div className="px-2 border-ad">
                                <div className="row">
                                    <div className="col-md-12 pt-2">
                                        <div className=" ">
                                            <b className="title-blue float-left">{category}</b>
                                            <b className="float-right ">{dateOfAd}</b>
                                        </div>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-12">
                                        <img className="image_ad" src={image}/>
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col-md-8">
                                        {oldPrice}
                                        {newPrice}
                                    </div>
                                    <div className="col-md-4">
                                        <span className="float-right mt-3">{place}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            )
        });
    }

    render()
    {

        if (this.props.result.length !== 0) {
            this.data = this.props.result;
            const { currentPage, itemPerPage } = this.state;

            // Logic for displaying Items
            const indexOfLastItem = currentPage * itemPerPage;
            const indexOfFirstItem = indexOfLastItem - itemPerPage;
            const currentItems = this.data.slice(indexOfFirstItem, indexOfLastItem);


            // Logic for displaying page numbers
            const pageNumbers = [];
            for (let i = 1; i <= Math.ceil(this.data.length / itemPerPage); i++) {
                pageNumbers.push(i);
            }

            const renderPageNumbers = pageNumbers.map(number => {
                return (
                        <li className={this.state.currentPage === number ? 'active page-item' : 'page-item'}key={number}>
                            <a  id={number} onClick={this.handleClick} className="page-link ">
                                {number}
                            </a>
                        </li>
                );
            });

            return (
                <div >
                    <div className="row" >
                        {this.renderResult(currentItems)}
                    </div>
                    <div className="pagination-search row justify-content-center mt-4">
                        <div className="navigation">
                            <nav>
                                <ul className="pagination justify-content-center">
                                    <li className="page-item">
                                        <a  id={this.state.currentPage-1} onClick={this.handleClick} className="page-link" >
                                            « Previous
                                        </a>
                                    </li>
                                    {renderPageNumbers}
                                    <li className="page-item">
                                        <a  id={this.state.currentPage+1} onClick={this.handleClick} className="page-link">
                                            Next »
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            );
        } else {
            return (
                <div key={Math.random()}>
                    <h1 className="text-center">There is no results :(</h1>
                </div>
            );
        }
    }
}export default ListsAds;
