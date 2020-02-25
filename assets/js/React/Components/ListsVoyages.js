import React from 'react';

class ListsVoyages extends React.Component {
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

    isHighway(highway) {
        if(highway){
            return (
                <span className="blued mt-2 mr-4 "><i className="fas fa-road"></i></span>

            );
        }
        return (<div></div>);

    }
    isArrivalDate(arrivalDate) {
        if(arrivalDate === '.'){
            return (
                <p className="white very-small text-center">{arrivalDate}</p>
            );
        }
        return (<p className="rosed very-small text-center">{arrivalDate}</p>);

    }
    getSeats(seats) {
        if(seats > 1){
            return (
                <span className="badge badge-info mt-1 btn-block"><h7>{seats} Seats available</h7></span>
            );
        }
        return (<span className="badge badge-info mt-1 btn-block"><h7>{seats} Seat available</h7></span>);

    }

    renderResult(items){

        return items.map((result) => {

            const id = result.id;
            const creatorName = result.creatorName;
            const creatorImage = result.creatorImage;
            const creatorPoint = result.creatorPoint;
            const creatorRating = result.creatorRating;
            const highway = result.highway;
            const timeDeparture = result.timeDeparture;
            const timeArrival = result.timeArrival;
            const departure = result.departure;
            const arrival = result.arrival;
            const price = result.price;
            const arrivalDate = result.arrivalDate;
            const departureDate = result.departureDate;
            const seats = result.seats;
            const favorite = result.favorite;


            let url = Routing.generate('voyage_show', {'id': id});

            let favoriteStatus;
            if(favorite === 'false'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add float-right ml-2" data-object={id} data-type="voyage" data-favorite="false">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart "></span>
                            </div>
                        </div>
                    </form>;
            }
            else if(favorite === 'true'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add float-right ml-2" data-object={id} data-type="voyage" data-favorite="true">
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
                <div className=" col-md-3 px-md-2 my-2 ad_show" key={Math.random()}>
                    <div id="ad_index" className="ad_index">
                        <a href={url} className="">
                            <div className="px-2 border-ad">
                                <div className="row">
                                    <div className="col-md-2 mt-1">
                                        <img src={creatorImage} alt="" className="cafe-avatar"/>
                                    </div>
                                    <div className="col-md-7 mt-1">
                                        <span className="d-block rosed small">{creatorName}</span>
                                        <span className="d-block blued small">{creatorPoint} Points</span>
                                        <span className="d-block blued small">{creatorRating} <i className="far fa-star rosed"></i></span>
                                    </div>
                                    <div className="col-md-3 mt-2">
                                        {this.isHighway(highway)}
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="col my-4">
                                        <div className="row">
                                            <div className="col-md-2 offset-3 ">
                                                <span className="float-right mb-1 city-time">{timeDeparture}</span>
                                            </div>
                                            <div className="col-md-2 text-center">
                                                <span className="point-departre pl-0"><i className="fas fa-car"></i></span>
                                                <span className="point-departre  d-block "><i className="fas fa-grip-lines-vertical"></i></span>
                                                <span className="point-departre  d-block "><i className="fas fa-grip-lines-vertical"></i></span>
                                            </div>
                                            <div className="col-md-4">
                                                <span className="rosed city-time">{departure}</span>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-2 offset-5 text-center">
                                                <span className="point-departre d-block mt-0"><i className="fas fa-grip-lines-vertical"></i></span>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-2 offset-3 ">
                                                <span className="float-right mb-1 city-time">
                                                    {timeArrival}
                                                    {this.isArrivalDate(arrivalDate)}
                                                </span>
                                            </div>
                                            <div className="col-md-2 text-center">
                                                <span className="point-departre d-block mb-0"><i className="far fa-dot-circle"></i></span>
                                            </div>
                                            <div className="col-md-4">
                                                <span className="rosed city-time">
                                                    {arrival}
                                                </span>
                                            </div>
                                        </div>
                                        <div className="row">
                                            <div className="col-md-8 offset-2">
                                                {this.getSeats(seats)}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="row ">
                                    <div className="col-md-6">
                                        <span>{departureDate}</span>
                                    </div>
                                    <div className="col-md-6 ">
                                        <div>
                                            {favoriteStatus}
                                        </div>
                                        <span className="float-right">
                                            {price} €
                                        </span>
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
}export default ListsVoyages;
