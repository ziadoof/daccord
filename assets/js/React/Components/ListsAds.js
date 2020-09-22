import React from 'react';
import Translator from "bazinga-translator";

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
            const category = Translator.trans(result.category);
            const imageOne = result.imageOne;
            const imageTow = result.imageTow;
            const imageThree = result.imageThree;
            const price = result.price;
            const pPrice = result.pPrice;
            const city = result.city;
            const ville = result.ville;
            const dateOfAd = result.dateOfAd;
            const typeOfAd = result.typeOfAd;
            const favorite = result.favorite;
            const donate = result.donate;

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
                        offerImage = "../../assets/images/icons/offer.png";
                    }
                }
            }
            let demandImage = "../../assets/images/icons/demand.png";
            let image;
            let mine_class ;
            if (typeOfAd === 'Offer') {
                image = offerImage;
                mine_class = "shadow-border  mx-1 ad_offer";
            } else {
                image = demandImage;
                mine_class = "shadow-border  mx-1 ad_demand";
            }


            let oldPrice;
            let newPrice;
            if(donate){
                let transDonate = Translator.trans('Donate');
                oldPrice = <div></div>;
                newPrice = <h6 className="blued mb-0 font-weight-bold d-inline mr-2 float-right">{transDonate}</h6>;
            }
            else{
                if(pPrice){
                    oldPrice =  <h5 className="rosed mb-0 font-weight-bold d-inline mr-2 float-right"><del>{pPrice}€</del></h5>;
                }
                if(price){
                    newPrice = <h6 className="blued mb-0 font-weight-bold d-inline mr-2 float-right">{price}€</h6>;
                }
                else{
                    newPrice = <div></div>;
                }

            }


            let place;
            if (city === null) {
                place = ville;
            } else {
                place = city;
            }
            let url = Routing.generate('ad_show', {'id': id});

            let favoriteStatus;
            if(favorite === 'false'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add  ad-favorite2 mr-4 mt-1" data-object={id} data-type="ad" data-favorite="false">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart "></span>
                            </div>
                        </div>
                    </form>;
            }
            else if(favorite === 'true'){
              favoriteStatus =
                  <form method="post" action="" className="js-favorite-add  ad-favorite2 mr-4 mt-1" data-object={id} data-type="ad" data-favorite="true">
                      <div className="flexbox">
                          <div className="fav-btn">
                            <span className="fas fa-heart  favme dashicons dashicons-heart active"></span>
                          </div>
                      </div>
                  </form>;
            }
            else{
                favoriteStatus = <div></div>;
            }

            return (
                <div className="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4" key={Math.random()}>
                    <div id=""  className={mine_class}>
                        <a href={url} className="">
                            <div className="row ">
                                <div className="col-12">
                                    {favoriteStatus}
                                    <div className="text-center">
                                        <div className="ad-photo-index text-center">
                                            <img className="image_ad2" src={image} />
                                        </div>
                                        <div className="row">
                                            <div className="col mt-1">
                                                <b className="mt-0 blacked font-weight-bolder float-left pl-2">{category}</b>
                                                {oldPrice}
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col mt-0">
                                                <h6 className="mt-0 blacked float-left pl-2">{place}</h6>
                                                {newPrice}
                                            </div>
                                        </div>
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
                    <div className="row no-gutters" >
                        {this.renderResult(currentItems)}
                    </div>
                    <div className="pagination-search row justify-content-center mt-4">
                        <div className="navigation">
                            <nav>
                                <ul className="pagination justify-content-center">
                                    <li className="page-item">
                                        <a  id={this.state.currentPage-1} onClick={this.handleClick} className="page-link" >
                                            « {Translator.trans('Previous')}
                                        </a>
                                    </li>
                                    {renderPageNumbers}
                                    <li className="page-item">
                                        <a  id={this.state.currentPage+1} onClick={this.handleClick} className="page-link">
                                            {Translator.trans('Next')} »
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
                    <h1 className="text-center blued">{Translator.trans('There is no results')}</h1>
                </div>
            );
        }
    }
}export default ListsAds;
