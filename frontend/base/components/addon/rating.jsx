const Rating = ({ rating }) => {
  const dieStars = Array.from({ length: 5 }, (_, index) => index < 5);
  const aliveStars = Array.from({ length: 4 }, (_, index) => index < rating);

  return (
    <div className={`relative`}>
      <div className={`absolute left-0 xs:text-wrap text-nowrap`}>
        {dieStars.map((_, index) => (
          <i key={index} className="pi pi-star"></i>
        ))}
      </div>
      <div className={`absolute left-0 xs:text-wrap text-nowrap`}>
        {aliveStars.map((_, index) => (
          <i key={index} className="pi pi-star-fill"></i>
        ))}
      </div>
    </div>
  );
};

export default Rating;
